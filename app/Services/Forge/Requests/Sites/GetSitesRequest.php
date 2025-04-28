<?php

namespace App\Services\Forge\Requests\Sites;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetSitesRequest extends Request
{

    public function __construct(protected readonly string|int $serverId) {}

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/servers/{$this->serverId}/sites";
    }
}
