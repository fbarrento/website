<?php

declare(strict_types=1);

namespace App\Enums;

enum ServerType: string
{
    case Web = 'web';
    case LoadBalancer = 'loadbalancer';
    case Database = 'database';
}
