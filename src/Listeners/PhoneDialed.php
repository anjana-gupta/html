<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Listeners;

use ValmarHoldings\DialerCore\Events\PhoneNumberWasDialed;
use ValmarHoldings\DialerLiftUp\Bases\Listener;
use ValmarHoldings\DialerLiftUp\Http\Resources\DialNumber;

class PhoneDialed extends Listener
{
    public function handle(PhoneNumberWasDialed $event): void
    {
        if (! $this->canProcessEvent($event)) {
            return;
        }

        (new DialNumber($event->phoneCall))
            ->execute();
    }
}
