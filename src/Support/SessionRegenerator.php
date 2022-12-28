<?php

declare(strict_types = 1);

namespace Support;

use App\Events\AfterSessionRegeneratedEvent;

final class SessionRegenerator
{
    public static function run(callable $callback = null): void
    {
        $old = request()?->session()->getId();

        request()?->session()->invalidate();
        request()?->session()->regenerateToken();

        if (!is_null($callback)) {
            $callback();
        }

        event(new AfterSessionRegeneratedEvent(
            $old,
            request()?->session()->getId()
        ));
    }
}