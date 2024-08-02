<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Listeners;

use ValmarHoldings\DialerCore\Events\ContactWasAdded;
use ValmarHoldings\DialerLiftUp\Bases\Listener;
use ValmarHoldings\DialerLiftUp\Http\Resources\AddContact;

class ContactAdded extends Listener
{
    public function handle(ContactWasAdded $event): void
    {
        if (! $this->canProcessEvent($event)) {
            return;
        }

        (new AddContact($event->contact))
            ->execute();
    }
}
