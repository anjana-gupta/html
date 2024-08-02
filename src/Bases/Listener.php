<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerPackage\Bases;

use Illuminate\Support\Str;
use ValmarHoldings\DialerPackage\Providers\Service;

abstract class Listener
{
    protected function canProcessEvent(mixed $event): bool
    {
        return ! Str::startsWith($event->processor, Service::$packageName)
            || ! Service::isEnabled()
    }
}
