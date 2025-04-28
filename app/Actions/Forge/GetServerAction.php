<?php

declare(strict_types=1);

namespace App\Actions\Forge;

use App\Services\Forge\ForgeConnector;
use App\Services\Forge\Requests\Servers\GetServerRequest;

final class GetServerAction
{

    public function __construct(
        protected readonly ForgeConnector $forge
    ) {}

    public function handle(string|int $serverId): array
    {
        $response = $this->forge->send(new GetServerRequest($serverId));

        return $response->json('server');
    }


}
