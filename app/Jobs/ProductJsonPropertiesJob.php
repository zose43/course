<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Domain\Product\Models\Product;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProductJsonPropertiesJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    public function __construct(public Product $product) {}

//todo fix uniq with repeated elements (relation has many)
    public function handle(): void
    {
        $properties = $this->product
            ->properties
            ->withTitle();
        $this->product->updateQuietly(['json_properties' => $properties]);
    }

    public function uniqueId(): mixed
    {
        return $this->product->getKey();
    }
}