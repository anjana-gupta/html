<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerPackage\Listeners;

use Illuminate\Support\Str;
use Throwable;
use ValmarHoldings\DialerCore\Events\ContactWasAdded as ContactWasAddedEvent;

class ContactWasAdded extends Listener
{
    public function handle(ContactWasAddedEvent $event): void
    {
        if (! $this->canProcessEvent($event)) {
            return;
        }

        (new AddContact($event->contact))->execute();
    }
}
