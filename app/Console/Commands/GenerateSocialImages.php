<?php

namespace App\Console\Commands;

use App\Services\PlaywrightSocialImageRenderer;
use App\Services\SocialImageGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GenerateSocialImages extends Command
{
    protected $signature = 'social:generate
        {slug : The Prezet document slug}
        {--draft : Include draft documents}
        {--force : Overwrite existing assets if present}';

    protected $description = 'Generate LinkedIn, X, and Website social images for a given article.';

    public function __construct(
        private readonly SocialImageGenerator $generator,
        private readonly PlaywrightSocialImageRenderer $renderer,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $slug = strval($this->argument('slug'));
        $includeDrafts = (bool) $this->option('draft');
        $force = (bool) $this->option('force');

        $result = $this->generator->forSlug($slug, $includeDrafts);

        $contentType = $result->document->content_type ?? 'article';
        $storagePath = storage_path("app/social/{$slug}");

        $imagesDirectory = match ($contentType) {
            'project' => $this->getProjectImagesDirectory($result->document),
            default => "images/{$contentType}",
        };

        File::ensureDirectoryExists($storagePath);

        File::put("{$storagePath}/linkedin.html", $result->linkedinHtml);
        File::put("{$storagePath}/x.html", $result->xHtml);
        File::put("{$storagePath}/website.html", $result->websiteHtml);
        if (! empty($result->svgMarkup)) {
            File::put("{$storagePath}/architecture.svg", $result->svgMarkup);
        }

        $tempDestination = storage_path("app/social/{$slug}/output");

        $generated = $this->renderer->render(
            slug: $slug,
            htmlFiles: [
                'linkedin' => "{$storagePath}/linkedin.html",
                'x' => "{$storagePath}/x.html",
                'website' => "{$storagePath}/website.html",
            ],
            destinationDirectory: $tempDestination,
            overwrite: $force,
        );

        $prezetDisk = Storage::disk('prezet');
        $prezetDisk->makeDirectory($imagesDirectory);

        $finalPaths = [];

        foreach ($generated as $platform => $tempPath) {
            $filename = "{$slug}-{$platform}.webp";
            $finalPath = "{$imagesDirectory}/{$filename}";

            if (! $force && $prezetDisk->exists($finalPath)) {
                $this->components->warn("Skipping {$platform} - file already exists. Use --force to overwrite.");

                continue;
            }

            $prezetDisk->put($finalPath, File::get($tempPath));
            File::delete($tempPath);

            $finalPaths[$platform] = $prezetDisk->path($finalPath);
            $this->components->twoColumnDetail(strtoupper($platform).' webp', $finalPaths[$platform]);
        }

        $this->components->info(sprintf(
            'Generated assets for [%s] (%s) at %s.',
            $slug,
            $contentType,
            $prezetDisk->path($imagesDirectory),
        ));

        return self::SUCCESS;
    }

    private function getProjectImagesDirectory($document): string
    {
        $type = $document->frontmatter->type ?? 'sdk';

        return "images/project/{$type}";
    }
}
