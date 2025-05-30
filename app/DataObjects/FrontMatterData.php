<?php

declare(strict_types=1);

namespace App\DataObjects;

use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Sometimes;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

final class FrontMatterData extends Data
{
    public function __construct(
        #[Required, StringType]
        public string $title,

        #[Required, StringType]
        public string $excerpt,

        #[Nullable, StringType]
        public ?string $category,

        #[Sometimes, StringType]
        public string $layout,

    ) {}
}
