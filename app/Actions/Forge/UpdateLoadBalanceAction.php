<?php

declare(strict_types=1);

namespace App\Actions\Forge;

use App\Services\Forge\ForgeConnector;
use App\Services\Forge\Requests\Sites\UpdateLoadBalanceRequest;

final readonly class UpdateLoadBalanceAction
{

    public function __construct(
        protected ForgeConnector $forge
    ) {}

    public function handle(string|int $serverId, string|int $siteId, array $payload): ?array
    {

        $request = new UpdateLoadBalanceRequest(
            serverId: $serverId,
            siteId: $siteId,
        );

        $request->body()
            ->set($payload);

        $response = $this->forge->send($request);

        return $response->json('servers');


    }

}
