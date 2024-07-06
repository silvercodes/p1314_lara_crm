<?php

declare(strict_types=1);

namespace App\Enums;

enum TokenAbility: string
{
    case ACCESS_API = 'access-api';
    case REFRESH_ACCESS_TOKEN = 'refresh-access-token';
}
