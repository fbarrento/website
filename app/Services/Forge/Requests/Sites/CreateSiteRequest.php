<?php

namespace App\Services\Forge\Requests\Sites;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateSiteRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(protected readonly string|int $serverId) {}

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/servers/{$this->serverId}/sites";
    }
}
