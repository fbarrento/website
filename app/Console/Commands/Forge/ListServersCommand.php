<?php

namespace App\Console\Commands\Forge;

use App\Actions\Forge\ListServersAction;
use Illuminate\Console\Command;

class ListServersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:list-servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ListServersAction $listServersAction): void
    {

        $servers = $listServersAction->handle();

        $this->table(
            headers: ['Id',  'Name', 'Type', 'IsReady'],
            rows: $servers->select('id', 'name', 'type', 'is_ready')->toArray()
        );

    }

    private function list(array $servers): array
    {
        return [];
    }
}
