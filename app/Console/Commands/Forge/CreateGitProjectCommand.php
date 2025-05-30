<?php

namespace App\Console\Commands\Forge;

use App\Actions\Forge\CreateGitProjectAction;
use Illuminate\Console\Command;

use function base_path;
use function file_get_contents;
use function json_decode;

class CreateGitProjectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:create-git-project {--environment=stage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CreateGitProjectAction $createGitProjectAction)
    {
        $content = file_get_contents(base_path('/infrastructure/'.$this->option('environment').'.json'));
        $deploymentData = json_decode($content, true);

        $gitData = $deploymentData['git'];
        $serverId = $deploymentData['serverId'];
        $siteId = $deploymentData['siteId'];

        $git = $createGitProjectAction->handle(
            serverId: $serverId,
            siteId: $siteId,
            payload: $gitData
        );

        dd($git);

    }
}
