<?php

declare(strict_types=1);

namespace App\Actions\Forge;

use App\Services\Forge\ForgeConnector;
use App\Services\Forge\Requests\Sites\CreateSiteRequest;

final class CreateSiteAction
{

    public function __construct(
        protected readonly ForgeConnector $forge,
    ) {}

    public function handle(string|int $serverId, array $payload): array
    {
        $request = new CreateSiteRequest(
            serverId: $serverId,
        );

        $request->body()
            ->set($payload);

        $response = $this->forge->send($request);

        return $response->json();
    }

}
