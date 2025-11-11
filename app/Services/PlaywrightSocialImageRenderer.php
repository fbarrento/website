<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use RuntimeException;

final class PlaywrightSocialImageRenderer
{
    /**
     * @param  array<string, string>  $htmlFiles  keyed by platform
     * @return array<string, string> keyed by platform with generated image paths
     */
    public function render(string $slug, array $htmlFiles, string $destinationDirectory, bool $overwrite = false): array
    {
        $jobs = [];

        $temporaryOutputs = [];

        foreach ($htmlFiles as $platform => $htmlPath) {
            $resolvedPath = realpath($htmlPath);

            if ($resolvedPath === false) {
                throw new RuntimeException("Unable to resolve HTML file for [{$platform}] at [{$htmlPath}].");
            }

            $finalOutputPath = $destinationDirectory.DIRECTORY_SEPARATOR.$platform.'.webp';
            $temporaryOutputPath = $destinationDirectory.DIRECTORY_SEPARATOR.$platform.'.png';

            if (! $overwrite && File::exists($finalOutputPath)) {
                continue;
            }

            $dimensions = match ($platform) {
                'linkedin' => ['width' => 1080, 'height' => 1350],
                'website' => ['width' => 2200, 'height' => 1100],
                default => ['width' => 1200, 'height' => 675], // x
            };

            $jobs[] = [
                'name' => $platform,
                'html' => $resolvedPath,
                'output' => $temporaryOutputPath,
                'format' => 'png',
                'width' => $dimensions['width'],
                'height' => $dimensions['height'],
                'scale' => 2,
                'waitFor' => 250,
            ];

            $temporaryOutputs[$platform] = [
                'png' => $temporaryOutputPath,
                'webp' => $finalOutputPath,
            ];
        }

        if ($jobs === []) {
            return [];
        }

        File::ensureDirectoryExists($destinationDirectory);

        $configPath = storage_path("app/social/{$slug}/render-config.json");

        File::put(
            $configPath,
            json_encode(['jobs' => $jobs], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );

        $scriptPath = base_path('resources/scripts/render-social-images.mjs');

        if (! File::exists($scriptPath)) {
            throw new RuntimeException('Playwright render script not found.');
        }

        $result = Process::command([
            'node',
            $scriptPath,
            $configPath,
        ])->timeout(120)->run();

        if ($result->failed()) {
            throw new RuntimeException(trim($result->errorOutput() ?: $result->output()));
        }

        $outputs = [];

        if (! function_exists('imagewebp')) {
            throw new RuntimeException('imagewebp() is not available. Ensure PHP GD with WebP support is installed.');
        }

        foreach ($temporaryOutputs as $platform => $paths) {
            $pngPath = $paths['png'];
            $webpPath = $paths['webp'];

            if (! File::exists($pngPath)) {
                throw new RuntimeException("Expected PNG screenshot for [{$platform}] was not created.");
            }

            $image = imagecreatefrompng($pngPath);

            if ($image === false) {
                throw new RuntimeException("Unable to open PNG screenshot for [{$platform}] at [{$pngPath}].");
            }

            if (function_exists('imagepalettetotruecolor')) {
                imagepalettetotruecolor($image);
            }

            if (! imagewebp($image, $webpPath, 95)) {
                imagedestroy($image);
                throw new RuntimeException("Failed to convert PNG to WebP for [{$platform}].");
            }

            imagedestroy($image);

            File::delete($pngPath);

            $outputs[$platform] = $webpPath;
        }

        return $outputs;
    }
}
