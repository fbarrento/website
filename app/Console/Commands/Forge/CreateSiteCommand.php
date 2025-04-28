<?php

namespace App\Console\Commands\Forge;

use App\Services\Forge\ForgeConnector;
use App\Services\Forge\Requests\Sites\CreateSiteRequest;
use Illuminate\Console\Command;

class CreateSiteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:create-site {--environment=stage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new Site';

    /**
     * Execute the console command.
     */
    public function handle(ForgeConnector $forge): void
    {


        $content = file_get_contents(base_path('/infrastructure/'. $this->option('environment').'.json'));
        $deploymentData = json_decode($content, true);

        $siteData = $deploymentData['site'];
        $server =  $deploymentData['serverId'];

        $request = new CreateSiteRequest($server);
        $request->body()
            ->set($siteData);


        $response = $forge->send($request);

        dd($response->json());



    }
}
