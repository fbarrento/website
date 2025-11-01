<?php

namespace App\Data;

use Prezet\Prezet\Data\FrontmatterData;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class ExtendedFrontmatterData extends FrontmatterData
{
    #[Rules(['string', 'in:article,category,video,page,block'])]
    public string $contentType;

    #[Rules(['nullable', 'string', 'url'])]
    public ?string $github = null;

    #[Rules(['nullable', 'string', 'url'])]
    public ?string $linkedin = null;

    #[Rules(['nullable', 'string', 'url'])]
    public ?string $x = null;

    #[Rules(['nullable', 'string', 'url'])]
    public ?string $pinkary = null;
}
