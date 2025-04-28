<?php

declare(strict_types=1);

namespace App\Actions\Forge;

use App\Services\Forge\ForgeConnector;
use App\Services\Forge\Requests\Servers\GetServersRequest;
use Illuminate\Support\Collection;
use function collect;

final class ListServersAction
{

    public function __construct(
        protected readonly ForgeConnector $forge,
        protected readonly GetServersRequest $getServersRequest
    ) {}

    public function handle(): Collection
    {

        $response = $this->forge->send($this->getServersRequest);
        $servers = $response->json('servers');

        return collect($servers);

    }

}
