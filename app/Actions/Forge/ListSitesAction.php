<?php

declare(strict_types=1);

namespace App\Actions\Forge;

use App\Services\Forge\ForgeConnector;
use App\Services\Forge\Requests\Sites\GetSitesRequest;
use Illuminate\Support\Collection;

final readonly class ListSitesAction
{

    public function __construct(
        protected ForgeConnector  $forge
    ) {}

    public function handle(string|int $serverId): Collection
    {

        $response = $this->forge->send(new GetSitesRequest($serverId));

        $sites = $response->json('sites');;

        return collect($sites);

    }

}
