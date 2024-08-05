<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Listeners;

use ValmarHoldings\DialerCore\Events\ContactWentOnDoNotCall;
use ValmarHoldings\DialerLiftUp\Bases\Listener;
use ValmarHoldings\DialerLiftUp\Http\Resources\AddDoNotCallNumber;

class AddContactToDNC extends Listener
{
    public function handle(ContactWentOnDoNotCall $event): void
    {
        if (! $this->canProcessEvent($event)) {
            return;
        }
        $lead = "";
        (new AddDoNotCallNumber($lead))
            ->execute();
    }
}
