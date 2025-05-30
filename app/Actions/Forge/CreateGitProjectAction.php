<?php

declare(strict_types=1);

namespace App\Actions\Forge;

use App\Services\Forge\ForgeConnector;
use App\Services\Forge\Requests\GitProjects\CreateGitProjectRequest;

final readonly class CreateGitProjectAction
{
    public function __construct(
        protected ForgeConnector $forge,
    ) {}

    public function handle(int|string $serverId, int|string $siteId, array $payload): array
    {

        $request = new CreateGitProjectRequest(
            serverId: $serverId,
            siteId: $siteId,
        );

        $request->body()
            ->set($payload);

        $response = $this->forge->send($request);

        return $response->json();

    }
}
