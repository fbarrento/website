<?php

declare(strict_types=1);

namespace App\Actions\Content;

use Illuminate\Config\Repository as Config;
use Symfony\Component\Finder\Finder;

use function str_replace;

final readonly class ListFilesAction
{
    protected string $docsFolder;

    public function __construct(
        protected Config $config,
        protected Finder $finder
    ) {

        $this->docsFolder = $this->config->string('laravel-press.docs_folder');

    }

    public function handle(string $path): array
    {

        $files = collect();

        $this->finder->files()
            ->in(str_replace('//', '/', "$this->docsFolder/$path"))
            ->name('*.md');

        if ($this->finder->hasResults()) {
            foreach ($this->finder as $file) {
                $files->push(
                    $file
                );
            }
        }

        return $files->toArray();

    }
}
