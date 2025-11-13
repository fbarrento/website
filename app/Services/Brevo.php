<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Config\Repository;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final readonly class Brevo
{
    private PendingRequest $http;

    public function __construct(
        private Repository $config
    ) {
        $this->http = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'api-key' => $this->config->get('services.brevo.api_key'),
        ])
            ->baseUrl($this->config->string('services.brevo.url'));
    }

    /**
     * @throws ConnectionException
     */
    public function CreateContact(string $email): void
    {
        $this->http->post('/contacts', [
            'email' => $email,
        ]);
    }
}
