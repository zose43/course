<?php

namespace Domain\Order\QueryBuilders;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class PaymentMethodQueryBuilder extends Builder
{
    public function all(): Collection
    {
        return $this->query->get();
    }
}