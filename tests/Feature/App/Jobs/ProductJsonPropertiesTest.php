<?php

namespace Tests\Feature\App\Jobs;

use Queue;
use Tests\TestCase;
use App\Jobs\ProductJsonPropertiesJob;
use Database\Factories\ProductFactory;
use Database\Factories\PropertyFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @coversDefaultClass ProductJsonPropertiesJob
 */
class ProductJsonPropertiesTest extends TestCase
{
    use RefreshDatabase;

    private mixed $queue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->queue = Queue::getFacadeRoot();
        Queue::fake([ProductJsonPropertiesJob::class]);
    }

    /**
     * @test
     */
    public function is_created_json_properties(): void
    {
        $properties = PropertyFactory::new()
            ->count(10)
            ->create();
        $product = ProductFactory::new()
            ->hasAttached($properties, function () {
                return ['value' => fake()->word()];
            })->createOne();

        $this->assertEmpty($product->json_properties);

        Queue::swap($this->queue);
        ProductJsonPropertiesJob::dispatchSync($product);

        $product->refresh();

        $this->assertNotEmpty($product->json_properties);
    }
}