<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Prezet\Prezet\Data\DocumentData;
use Prezet\Prezet\Models\Document;
use Prezet\Prezet\Prezet;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $author = config('prezet.authors.francisco');

        // Load the about block
        $aboutBlock = app(Document::class)::query()
            ->where('content_type', 'block')
            ->where('slug', 'blocks/about')
            ->where('draft', false)
            ->first();

        $aboutBlockData = null;
        if ($aboutBlock) {
            $md = Prezet::getMarkdown($aboutBlock->filepath);
            $html = Prezet::parseMarkdown($md)->getContent();
            $aboutBlockData = Prezet::getDocumentDataFromFile($aboutBlock->filepath);
            $aboutBlockData->content = $html;
        }

        $latestPosts = app(Document::class)::query()
            ->where('content_type', 'article')
            ->where('draft', false)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $postsData = $latestPosts->map(fn (Document $doc) => app(DocumentData::class)::fromModel($doc));

        return view('home', [
            'author' => $author,
            'aboutPage' => $aboutBlockData,
            'latestPosts' => $postsData,
        ]);
    }
}
