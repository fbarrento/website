<?php

namespace App\Console\Commands\Forge;

use App\Actions\Forge\UpdateSiteAction;
use Illuminate\Console\Command;

use function base_path;
use function file_get_contents;
use function json_decode;

class UpdateSiteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:update-site {--environment=stage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(UpdateSiteAction $updateSiteAction): void
    {
        $content = file_get_contents(base_path('/infrastructure/'.$this->option('environment').'.json'));
        $deploymentData = json_decode($content, true);

        $siteData = $deploymentData['site'];
        $serverId = $deploymentData['serverId'];
        $siteId = $deploymentData['siteId'];

        $site = $updateSiteAction->handle(
            serverId: $serverId,
            siteId: $siteId,
            payload: $siteData
        );

        dd($site);

    }
}
