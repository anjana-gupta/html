<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider as BaseProvider;
use ValmarHoldings\DialerCore\Events\ContactsWereAdded;
use ValmarHoldings\DialerCore\Events\ContactWasAdded;
use ValmarHoldings\DialerCore\Events\PhoneNumberWasDialed;
use ValmarHoldings\DialerLiftUp\Listeners\ContactAdded;
use ValmarHoldings\DialerLiftUp\Listeners\ContactsAdded;
use ValmarHoldings\DialerLiftUp\Listeners\PhoneDialed;

class Service extends BaseProvider
{
    public static string $packageName = "liftup";

    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . "/../../config/dialer.php", "dialer");

        Event::listen(
            ContactsWereAdded::class,
            [ContactsAdded::class, "handle"],
        );
        Event::listen(ContactWasAdded::class, [ContactAdded::class, "handle"]);
        Event::listen(
            PhoneNumberWasDialed::class,
            [PhoneDialed::class, "handle"],
        );
    }

    public static function isEnabled(?string $packageName = "ucontact"): bool
    {
        $packageName = $packageName
            ?: self::$packageName;

        return config("dialer.{$packageName}.environment")
            && config("dialer.{$packageName}.password")
            && config("dialer.{$packageName}.username");
    }
}
