<?php

declare(strict_types=1);

namespace App\Actions\Markdown;

use App\DataObjects\FrontMatterData;
use Illuminate\Config\Repository;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Exception\CommonMarkException;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;

final class GetFrontMatterAction
{
    protected string $basePath;

    public function __construct(
        protected Repository $config
    ) {

        $this->basePath = $this->config->string('laravel-press.docs_folder');

    }

    /**
     * @throws CommonMarkException
     */
    public function handle(string $path): ?FrontMatterData
    {

        $environment = new Environment([]);
        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new FrontMatterExtension);
        $converter = new MarkdownConverter($environment);

        $contents = file_get_contents("$this->basePath/$path.md");

        $result = $converter->convert($contents);

        if ($result instanceof RenderedContentWithFrontMatter) {
            return FrontMatterData::from($result->getFrontMatter());
        }

        return null;

    }
}
