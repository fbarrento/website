<?php

namespace App\Data;

use Prezet\Prezet\Data\FrontmatterData;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class ExtendedFrontmatterData extends FrontmatterData
{
    #[Rules(['string', 'in:article,category,video,page,block,project'])]
    public string $contentType;

    #[Rules(['nullable', 'string', 'in:sdk,website,webapp'])]
    public ?string $type = null;

    #[Rules(['nullable', 'string', 'in:default,vibrant'])]
    public ?string $theme = null;
}
