<?php

namespace App\Services\Forge;

use Illuminate\Config\Repository;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use function config;

class ForgeConnector extends Connector
{




    public function resolveBaseUrl(): string
    {
        return config()->string('services.forge.base_url');
    }

    public function defaultAuth(): ?Authenticator
    {
        return new TokenAuthenticator(config()->string('services.forge.token'));
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
