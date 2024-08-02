<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Listeners;

use ValmarHoldings\DialerCore\Events\ContactsWereAdded;
use ValmarHoldings\DialerLiftUp\Bases\Listener;
use ValmarHoldings\DialerLiftUp\Http\Resources\AddContacts;

class ContactsAdded extends Listener
{
    public function handle(ContactsWereAdded $event): void
    {
        if (! $this->canProcessEvent($event)) {
            return;
        }

        (new AddContacts($event->contacts))
            ->execute();
    }
}
