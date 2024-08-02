<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerTemplate\Providers;

use Illuminate\Support\ServiceProvider as BaseProvider;
use Illuminate\Support\Facades\Event;

class Service extends BaseProvider
{
    public static string $packageName = "package";

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->mergeConfigFrom(__DIR__ . "/../../config/package.php", "dialer");
        // ! TODO: add event bindings
        Event::listen(
            PaymentMethodWasUpdatedEvent::class,
            [PaymentMethodWasUpdated::class, "handle"],
        );

    }

    public static function isEnabled(): bool
    {
        // ! TODO: update to check if config settings are set
        return config("dialer.{$event->processor}.merchant-login-id")
            && config("dialer.{$event->processor}.merchant-transaction-key")
            && config("dialer.{$event->processor}.environment");
    }
}
