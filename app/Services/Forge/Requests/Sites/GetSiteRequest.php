<?php

namespace App\Services\Forge\Requests\Sites;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetSiteRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/example';
    }
}
