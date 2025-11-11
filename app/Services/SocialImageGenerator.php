<?php

namespace App\Services;

use App\Data\SocialImagePayload;
use App\Data\SocialImageResult;
use App\Services\SocialImagePayloadGenerators\ArticlePayloadGenerator;
use App\Services\SocialImagePayloadGenerators\SdkPayloadGenerator;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Prezet\Prezet\Models\Document;

final class SocialImageGenerator
{
    public function __construct(
        private readonly Document $documents,
        private readonly ViewFactory $view,
        private readonly SdkPayloadGenerator $sdkPayloadGenerator,
        private readonly ArticlePayloadGenerator $articlePayloadGenerator,
    ) {}

    public function forSlug(string $slug, bool $includeDrafts = false): SocialImageResult
    {
        $document = $this->documents->newQuery()
            ->where('slug', $slug)
            ->when(! $includeDrafts, fn ($query) => $query->where('draft', false))
            ->firstOrFail();

        $contentType = $document->content_type ?? 'article';
        $payload = $this->generatePayload($document, $contentType);

        $templatePrefix = match ($contentType) {
            'project' => $this->getProjectTemplatePrefix($document),
            default => 'images.article',
        };

        $linkedinHtml = $this->view->make("{$templatePrefix}.linkedin", $payload->toViewData('linkedin'))->render();
        $xHtml = $this->view->make("{$templatePrefix}.x", $payload->toViewData('x'))->render();
        $websiteHtml = $this->view->make("{$templatePrefix}.website", $payload->toViewData('website'))->render();

        $svgMarkup = '';
        if ($contentType === 'project' && $this->view->exists('images.svg')) {
            $svgMarkup = $this->view->make('images.svg', $payload->toViewData())->render();
        }

        return new SocialImageResult(
            document: $document,
            payload: $payload,
            linkedinHtml: $linkedinHtml,
            xHtml: $xHtml,
            websiteHtml: $websiteHtml,
            svgMarkup: $svgMarkup,
        );
    }

    private function generatePayload(Document $document, string $contentType): SocialImagePayload
    {
        return match ($contentType) {
            'project' => $this->sdkPayloadGenerator->generate($document),
            default => $this->articlePayloadGenerator->generate($document),
        };
    }

    private function getProjectTemplatePrefix(Document $document): string
    {
        $type = $document->frontmatter->type ?? 'sdk';

        return "images.project.{$type}";
    }
}
