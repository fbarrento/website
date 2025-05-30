<?php

declare(strict_types=1);

namespace App\Actions\Forge;

use App\Services\Forge\ForgeConnector;
use App\Services\Forge\Requests\Sites\UpdateSiteRequest;

final class UpdateSiteAction
{
    public function __construct(
        protected readonly ForgeConnector $forge
    ) {}

    public function handle(string|int $serverId, string|int $siteId, array $payload): array
    {
        $request = new UpdateSiteRequest(
            serverId: $serverId,
            siteId: $siteId
        );

        $request->body()
            ->set($payload);

        $response = $this->forge->send($request);

        return $response->json('site');

    }
}
