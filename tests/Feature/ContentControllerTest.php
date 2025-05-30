<?php

declare(strict_types=1);

test('it renders the about page', function (): void {

    $response = $this->get('/about');

    expect($response->getStatusCode())
        ->toBe(200);

});
