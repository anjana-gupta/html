<?php

declare(strict_types=1);

use ValmarHoldings\DialerLiftUp\LiftUp;

return [
    "liftup" => [
        "authorization" => env("LIFTUP_AUTHORIZATION"),
        "environment" => env("LIFTUP_ENVIRONMENT", "SANDBOX"),
        "production-endpoint" => env("LIFTUP_PRODUCTION_ENDPOINT"),
        "proxyClass" => LiftUp::class,
        "sandbox-endpoint" => env("LIFTUP_SANDBOX_ENDPOINT", ""),
    ],
];