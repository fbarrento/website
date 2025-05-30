<?php

declare(strict_types=1);

use App\Actions\Markdown\GetFrontMatterAction;
use App\DataObjects\FrontMatterData;

beforeEach(function (): void {

    config()->set('laravel-press.docs_folder', base_path(
        'tests/fixtures/docs'
    ));

    $this->action = app(GetFrontMatterAction::class);

});

test('it gets the data from file', function (): void {

    // Act
    $data = $this->action->handle('about');

    // Assert
    expect($data)
        ->toBeInstanceOf(FrontMatterData::class);

});
