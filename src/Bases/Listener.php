<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Bases;

use ValmarHoldings\DialerLiftUp\Providers\Service;

abstract class Listener
{
    protected function canProcessEvent(): bool
    {
        return Service::isEnabled();
    }
}
