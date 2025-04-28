<?php

namespace App\Console\Commands\Forge;

use App\Actions\Forge\DeployConfigurationAction;
use Illuminate\Console\Command;

class DeployConfigurationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:deploy-configuration {--environment=stage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(DeployConfigurationAction $deployConfigurationAction)
    {
        $deployConfigurationAction->handle($this->option('environment'));
    }
}
