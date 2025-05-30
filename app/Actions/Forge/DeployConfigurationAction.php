<?php

namespace App\Actions\Forge;

use App\Enums\ServerType;

use function array_filter;
use function array_merge;
use function collect;

readonly class DeployConfigurationAction
{
    public function __construct(
        protected GetConfigurationAction $getConfigurationAction,
        protected CreateSiteAction $createSiteAction,
        protected CreateGitProjectAction $createGitProjectAction,
        protected ListSitesAction $listSitesAction,
        protected GetServerAction $getServerAction,
        protected UpdateLoadBalanceAction $updateLoadBalanceAction,
    ) {}

    public function handle(string $environment): void
    {

        $configuration = $this->getConfigurationAction->handle($environment);

        $servers = $configuration['servers'];
        $siteDefinition = $configuration['site'];

        $loadBalancersToInstall = array_filter(
            $servers,
            fn ($server) => $server['type'] == ServerType::LoadBalancer->value
            && $server['siteId'] === null
        );

        $webServersToInstall = array_filter(
            $servers,
            fn ($server) => $server['type'] == ServerType::Web->value
                && $server['siteId'] === null
        );

        $webServers = array_filter(
            $servers,
            fn ($server) => $server['type'] == ServerType::Web->value
                && $server['siteId'] !== null
        );

        $loadBalancers = array_filter(
            $servers,
            fn ($server) => $server['type'] == ServerType::LoadBalancer->value
                && $server['siteId'] !== null
        );

        foreach (array_merge($webServersToInstall, $loadBalancersToInstall) as $webServer) {
            $website = $this->createSiteAction->handle(
                serverId: $webServer['serverId'],
                payload: $siteDefinition,
            );
        }

        $sites = collect([]);

        foreach ($webServers as $webServer) {
            $sites = $this->listSitesAction->handle($webServer['serverId']);
            $sites->push($sites->toArray());
        }

        $sites = $sites->where('name', $siteDefinition['domain']);

        foreach ($loadBalancers as $loadBalancer) {
            $sites->each(function (array $site) use ($loadBalancer) {
                $this->updateLoadBalanceAction->handle(
                    serverId: $loadBalancer['serverId'],
                    siteId: $loadBalancer['siteId'],
                    payload: [
                        'servers' => [
                            'id' => ['id' => $site['server_id']],
                        ],
                    ]
                );
            });
        }

    }
}
