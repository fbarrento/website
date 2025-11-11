<?php

namespace App\Services\SocialImagePayloadGenerators;

use App\Data\SocialImagePayload;
use Prezet\Prezet\Models\Document;

final class ArticlePayloadGenerator
{
    public function generate(Document $document): SocialImagePayload
    {
        $frontmatter = $document->frontmatter;
        $authorKey = $frontmatter->author ?? null;
        $author = $authorKey ? config('prezet.authors.'.$authorKey, null) : null;

        $tags = $document->tags ? $document->tags->pluck('name')->toArray() : [];

        $footerNote = sprintf(
            'Updated %s • barrento.dev',
            $document->updated_at->toFormattedDateString()
        );

        $theme = $frontmatter->theme ?? 'default';

        return new SocialImagePayload(
            title: $frontmatter->title,
            tagline: $frontmatter->excerpt ?? '',
            excerpt: $frontmatter->excerpt ?? null,
            authorName: $author['name'] ?? null,
            authorBio: $author['bio'] ?? null,
            date: $document->updated_at->toFormattedDateString(),
            tags: $tags,
            category: $document->category,
            footerNote: $footerNote,
            theme: $theme,
        );
    }
}
