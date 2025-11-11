<?php

namespace App\Services\SocialImagePayloadGenerators;

use App\Data\SocialImagePayload;
use Prezet\Prezet\Models\Document;

final class SdkPayloadGenerator
{
    public function generate(Document $document): SocialImagePayload
    {
        $frontmatter = $document->frontmatter;
        $tagline = 'Laravel Cloud SDK Architecture at a glance.';

        $layers = [
            [
                'label' => 'Laravel Cloud Platform',
                'heading' => 'Laravel Cloud API',
                'description' => 'Applications · Deployments · Domains · Commands · Instances · WebSockets · Databases',
            ],
            [
                'label' => 'Community SDK',
                'heading' => 'Laravel Cloud SDK',
                'description' => 'Saloon powered http core, Lawman architecture validation, test-first workflows.',
            ],
            [
                'label' => 'Your Applications',
                'heading' => 'Framework agnostic delivery',
                'description' => 'Laravel, Symfony, and pure PHP projects share the same type-safe experience.',
            ],
        ];

        $highlights = [
            [
                'title' => 'Saloon Powered',
                'description' => 'Battle-tested HTTP abstraction with request/response pipelines.',
                'icon' => 'plug',
            ],
            [
                'title' => 'Type Safe',
                'description' => 'Backed enums, strict mode, and value objects for every response.',
                'icon' => 'shield-check',
            ],
            [
                'title' => '100% Coverage',
                'description' => 'PEST powered testing keeps integrations confident.',
                'icon' => 'test-tube-2',
            ],
            [
                'title' => 'Clean Architecture',
                'description' => 'Lawman keeps boundaries sharp and responsibilities clear.',
                'icon' => 'pencil-ruler',
            ],
        ];

        $layers[1]['features'] = $highlights;

        $audiences = [
            'Laravel Apps',
            'Symfony Apps',
            'Pure PHP Projects',
            'CLI Tooling',
        ];

        $layers[2]['audiences'] = $audiences;

        $footerNote = sprintf(
            'Updated %s • phpdevkits/laravel-cloud-sdk',
            $document->updated_at->toFormattedDateString()
        );

        $theme = $frontmatter->theme ?? 'default';

        return new SocialImagePayload(
            title: $frontmatter->title,
            tagline: $tagline,
            layers: $layers,
            highlights: $highlights,
            audiences: $audiences,
            footerNote: $footerNote,
            theme: $theme,
        );
    }
}
