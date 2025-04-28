<?php

namespace App\Services\Forge\Requests\Sites;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateLoadBalanceRequest extends Request implements HasBody
{

    use HasJsonBody;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::PUT;

    public function __construct(
        protected string|int $serverId,
        public string|int $siteId,
    ) {}


    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/servers/{$this->serverId}/sites/{$this->siteId}/balancing";
    }
}
