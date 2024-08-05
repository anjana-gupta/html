<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp;

use Illuminate\Support\Collection;
use ValmarHoldings\DialerCore\Contracts\Dialer;
use ValmarHoldings\DialerCore\Events\ContactsWereAdded;
use ValmarHoldings\DialerCore\Events\ContactWasAdded;
use ValmarHoldings\DialerCore\Events\PhoneNumberWasDialed;
use ValmarHoldings\DialerCore\ValueObjects\Contact;
use ValmarHoldings\DialerCore\ValueObjects\PhoneCall;
use ValmarHoldings\DialerLiftUp\Providers\Service;

class LiftUp implements Dialer
{
    public function addContact(Contact $contact): void
    {
        if ($this->isNotEnabled()) {
            return;
        }

        ContactWasAdded::dispatch($contact);
    }

    public function addContacts(Collection $contacts): void
    {
        if ($this->isNotEnabled()) {
            return;
        }

        ContactsWereAdded::dispatch($contacts);
    }

    //phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
    public function canCall(Contact $contact): void
    {
        // LiftUp does not have this functionality
        return;
    }

    //phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
    public function doNotCall(Contact $contact): void
    {
        // LiftUp does not have this functionality
        return;
    }

    // public function getCampaigns(): Collection
    // {
    //     $packageName = Service::$packageName;

    //     return collect([
    //         (new Campaign)->fill([
    //             "id" => config("dialer.{$packageName}.inbound-campaign"),
    //             "name" => config("dialer.{$packageName}.inbound-campaign"),
    //         ]),
    //     ]);
    // }

    public function isEnabled(): bool
    {
        return Service::isEnabled();
    }

    public function isNotEnabled(): bool
    {
        return ! Service::isEnabled();
    }

    public function make(PhoneCall $phoneCall): void
    {
        if ($this->isNotEnabled()) {
            return;
        }

        PhoneNumberWasDialed::dispatch($phoneCall);
    }
}
