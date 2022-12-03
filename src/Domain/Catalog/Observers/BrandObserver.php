<?php

namespace Domain\Catalog\Observers;

use Domain\Catalog\Models\Brand;
use Support\Traits\Models\FlushCache;

class BrandObserver
{
    use FlushCache;

    public function created(Brand $brand): void
    {
        $this->flush('brand');
    }

    public function updated(Brand $brand): void
    {
        $this->flush('brand');
    }

    public function deleted(Brand $brand): void
    {
        $this->flush('brand');
    }
}