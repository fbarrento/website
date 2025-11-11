<?php

namespace App\Http\Controllers\Prezet;

use Illuminate\View\View;
use Prezet\Prezet\Models\Document;
use Prezet\Prezet\Prezet;

class PageController
{
    public function __invoke(string $slug): View
    {

        $page = app(Document::class)::query()
            ->where('content_type', 'page')
            ->where('slug', $slug)
            ->where('draft', false)
            ->firstOrFail();

        $markdown = Prezet::getMarkdown($page->filepath);
        $html = Prezet::parseMarkdown($markdown)->getContent();
        $pageData = Prezet::getDocumentDataFromFile($page->filepath);
        $pageData->content = $html;

        return view('prezet.page', [
            'page' => $pageData,
        ]);
    }
}
