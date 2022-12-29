<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use Domain\Cart\CartManager;
use Database\Factories\ProductFactory;
use App\Http\Controllers\CartController;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @coversDefaultClass CartController
 */
class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CartManager::fake();
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CartController::index()
     */
    public function is_empty_cart(): void
    {
        $this->get(action([CartController::class, 'index']))
            ->assertOk()
            ->assertViewIs('cart.index')
            ->assertViewHas('items', collect([]));
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CartController::index()
     */
    public function is_not_empty_cart(): void
    {
        $product = ProductFactory::new()
            ->create();
        cart()->add($product, 1);

        $this->get(action([CartController::class, 'index']))
            ->assertOk()
            ->assertViewIs('cart.index')
            ->assertViewHas('items', cart()->cartItems());
    }
}