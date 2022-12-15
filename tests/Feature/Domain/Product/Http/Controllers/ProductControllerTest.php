<?php

namespace Tests\Feature\Domain\Product\Http\Controllers;

use Tests\TestCase;
use Domain\Product\Models\Product;
use Database\Factories\ProductFactory;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @coversDefaultClass ProductController
 */
class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = ProductFactory::new()
            ->createOne();
    }

    /**
     * @test
     */
    public function is_success_response(): void
    {
        $this->get(route('product', $this->product))
            ->assertOk()
            ->assertViewIs('product.shared.show');
    }

    /**
     * @test
     */
    public function is_session_last_views_added(): void
    {
        $response = $this->get(route('product', $this->product));
        $response->assertSessionHas('also.' . $this->product->id, $this->product->id);
    }

    /**
     * @test
     */
    public function is_last_views_products_hidden(): void
    {
        $this->get(route('product', $this->product))
            ->assertDontSee('Просмотренные товары');
    }

    /**
     * @test
     */
    public function is_title_equal(): void
    {
        $this->get(route('product', $this->product))
            ->assertSee($this->product->title);
    }
}