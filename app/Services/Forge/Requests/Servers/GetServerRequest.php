<?php

namespace App\Services\Forge\Requests\Servers;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetServerRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected string|int $serverId,
    ) {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/servers/{$this->serverId}";
    }
}
