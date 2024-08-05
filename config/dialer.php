<?php

declare(strict_types=1);

use ValmarHoldings\DialerLiftUp\LiftUp;

return [
    "liftup" => [
        "environment" => env("LIFTUP_ENVIRONMENT", "SANDBOX"),
        "authorization" => env("LIFTUP_AUTHORIZATION"),
        "production-endpoint" => env("LIFTUP_PRODUCTION_ENDPOINT"),
        "proxyClass" => LiftUp::class,
        "sandbox-endpoint" => env("LIFTUP_SANDBOX_ENDPOINT", ""),
    ],
];