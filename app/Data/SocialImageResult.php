<?php

namespace App\Data;

use Prezet\Prezet\Models\Document;

final class SocialImageResult
{
    public function __construct(
        public readonly Document $document,
        public readonly SocialImagePayload $payload,
        public readonly string $linkedinHtml,
        public readonly string $xHtml,
        public readonly string $websiteHtml,
        public readonly string $svgMarkup,
    ) {}
}
