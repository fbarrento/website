<?php

declare(strict_types=1);

namespace App\Services\Forge\Requests\Sites;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

final class UpdateSiteRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(
        protected int|string $serverId,
        protected int|string $siteId,
    ) {}

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::PUT;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "servers/{$this->serverId}/sites/{$this->siteId}";
    }
}
