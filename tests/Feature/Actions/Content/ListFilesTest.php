<?php

declare(strict_types=1);

use App\Actions\Content\ListFilesAction;

beforeEach(function () {

    config()->set('laravel-press.docs_folder', base_path(
        'tests/fixtures/docs'
    ));

    $this->action = app(ListFilesAction::class);

});

test('it returns a list of files', function (): void {

    // Act
    $files = $this->action->handle('/articles');

    expect($files)
        ->toHaveCount(3);

});
