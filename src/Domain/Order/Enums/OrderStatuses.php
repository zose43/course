<?php

declare(strict_types = 1);

namespace Domain\Order\Enums;

enum OrderStatuses: string
{
    case New = 'new';
    case Pending = 'pending';
    case Paid = 'paid';
    case Cancelled = 'cancelled';
}
