<?php

declare(strict_types=1);

namespace App\Actions\Forge;

use function base_path;
use function file_get_contents;
use function json_decode;

final class GetConfigurationAction
{
    public function handle(string $environment): array
    {

        $content = file_get_contents(base_path("/infrastructure/{$environment}.json"));

        return json_decode($content, true);

    }
}
