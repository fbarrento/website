<?php

namespace App\Console\Commands\Forge;

use App\Actions\Forge\ListServersAction;
use App\Actions\Forge\ListSitesAction;
use Illuminate\Console\Command;

use function Laravel\Prompts\select;

class ListSitesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:list-sites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists the sites of the server';

    /**
     * Execute the console command.
     */
    public function handle(ListServersAction $listServersAction, ListSitesAction $listSitesAction): void
    {
        $servers = $listServersAction->handle();
        $serversOptions = $servers->map(function ($server) {
            return ['id' => $server['id'], 'name' => $server['name']];
        })
            ->pluck('name', 'id')
            ->toArray();

        $server = select(
            label: 'Choose server',
            options: $serversOptions
        );

        $sites = $listSitesAction->handle($server);

        dd($sites);

    }
}
