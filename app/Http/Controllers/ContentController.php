<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use Spatie\YamlFrontMatter\YamlFrontMatter;

use function base_path;
use function collect;
use function glob;
use function is_dir;
use function pathinfo;

final class ContentController
{
    const HOME = 'about';

    protected string $docsFolder = '';

    public function __construct(
        protected readonly Config $config
    ) {

        $this->docsFolder = $this->config->string('laravel-press.docs_folder');

    }

    public function __invoke(?string $slug = null): Response
    {

        if (! $slug) {
            $slug = self::HOME;
        }

        if (is_dir(base_path("$this->docsFolder/{$slug}"))) {

            $files = glob(base_path("$this->docsFolder/{$slug}/*.md"));
            $data = collect();

            foreach ($files as $file) {
                $data->push([
                    ...pathinfo($file),
                    'created_at' => filemtime($file),
                ]);
            }

            dd($data->forPage(1, 2));

        }

        $file = base_path("$this->docsFolder/$slug.md");

        if (! file_exists($file)) {
            abort(404);
        }

        $contents = file_get_contents($file);

        $matter = YamlFrontMatter::parse($contents);

        $html = Str::markdown(
            string: $contents,
            options: [
                'html_input' => 'allow',
                'allow_unsafe_links' => false,
                'heading_permalink' => [
                    'symbol' => '#',
                ],
                'disallowed_raw_html' => [
                    'disallowed_tags' => ['style', 'xmp', 'iframe', 'noembed', 'noframes', 'script', 'plaintext'],
                ],

            ],
            extensions: [
                new HeadingPermalinkExtension,
                new TableOfContentsExtension,
                new FrontMatterExtension,
                new DisallowedRawHtmlExtension,
            ]
        );

        $layout = $matter->matter('layout') ?? 'page';

        return Inertia::render("content/$layout", [
            'html' => $html,
            'title' => $matter->matter('title'),
        ]);

    }
}
