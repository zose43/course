<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AfterSessionRegeneratedEvent
{
    use Dispatchable;
    use SerializesModels;
    use InteractsWithSockets;

    public function __construct(public string $old, public string $current) {}
}