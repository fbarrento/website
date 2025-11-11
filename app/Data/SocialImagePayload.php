<?php

namespace App\Data;

/**
 * @phpstan-type SocialFeature array{title: string, description: string, icon?: string}
 * @phpstan-type SocialLayer array{label: string, heading: string, description: string, features?: array<int, SocialFeature>, audiences?: array<int, string>}
 * @phpstan-type SocialHighlight array{title: string, description: string, icon?: string}
 */
final class SocialImagePayload
{
    /**
     * @param  array<int, SocialLayer>  $layers
     * @param  array<int, SocialHighlight>  $highlights
     * @param  array<int, string>  $audiences
     * @param  array<int, string>  $tags
     */
    public function __construct(
        public readonly string $title,
        public readonly string $tagline,
        public readonly array $layers = [],
        public readonly array $highlights = [],
        public readonly array $audiences = [],
        public readonly string $footerNote = '',
        public readonly ?string $excerpt = null,
        public readonly ?string $authorName = null,
        public readonly ?string $authorBio = null,
        public readonly ?string $date = null,
        public readonly array $tags = [],
        public readonly ?string $category = null,
        public readonly string $theme = 'default',
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toViewData(?string $platform = null): array
    {
        // For LinkedIn with vibrant theme, use subtle variant
        $effectiveTheme = $this->theme;
        if ($this->theme === 'vibrant' && $platform === 'linkedin') {
            $effectiveTheme = 'vibrant_subtle';
        }

        $themeConfig = config("social-image-themes.{$effectiveTheme}", config('social-image-themes.default'));

        return [
            'title' => $this->title,
            'tagline' => $this->tagline,
            'layers' => $this->layers,
            'highlights' => $this->highlights,
            'audiences' => $this->audiences,
            'footerNote' => $this->footerNote,
            'excerpt' => $this->excerpt,
            'authorName' => $this->authorName,
            'authorBio' => $this->authorBio,
            'date' => $this->date,
            'tags' => $this->tags,
            'category' => $this->category,
            'theme' => $effectiveTheme,
            'backgroundHorizontal' => $themeConfig['background_horizontal'],
            'backgroundVertical' => $themeConfig['background_vertical'],
        ];
    }
}
