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

    private function createData(): array
    {
        $quantity = 2;
        $product = ProductFactory::new()
            ->create();

        return [$quantity, $product];
    }

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
        [$quantity, $product] = $this->createData();
        cart()->add($product, $quantity);

        $this->get(action([CartController::class, 'index']))
            ->assertViewHas('items', cart()->cartItems())
            ->assertSee($product->title)
            ->assertSee($product->price)
            ->assertSee(cart()->amount())
            ->assertSee("$quantity шт");
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CartController::add()
     */
    public function is_added_successfully(): void
    {
        [$quantity, $product] = $this->createData();

        $this->assertEquals(0, cart()->count());

        $this->post(
            action([CartController::class, 'add'], $product),
            [
                'quantity' => $quantity,
            ])
            ->assertSessionHas('course_flash_msg', 'Товар добавлен в корзину');

        $this->assertNotEmpty(cart()->cartItems());
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CartController::quantity()
     */
    public function is_quantity_changed(): void
    {
        [$quantity, $product] = $this->createData();
        cart()->add($product, $quantity);

        $this->assertEquals($quantity, cart()->count());

        $this->post(
            action([CartController::class, 'quantity'], cart()->cartItems()->first()),
            [
                'quantity' => $quantity * 2,
            ])
            ->assertSessionHas('course_flash_msg', 'Кол-во товара изменено');

        $this->assertEquals($quantity * 2, cart()->count());
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CartController::quantity()
     */
    public function is_delete_success(): void
    {
        [$quantity, $product] = $this->createData();
        cart()->add($product, $quantity);

        $this->assertEquals($quantity, cart()->count());

        $this->delete(
            action([CartController::class, 'delete'], cart()->cartItems()->first()))
            ->assertSessionHas('course_flash_msg', 'Удалено из корзины');

        $this->assertEquals(0, cart()->count());
    }

    /**
     * @test
     * @covers \App\Http\Controllers\CartController::quantity()
     */
    public function is_truncate_success(): void
    {
        $product = ProductFactory::new()
            ->create();
        cart()->add($product, 1);

        $this->assertDatabaseCount('cart_items', 1);

        $this->delete(
            action([CartController::class, 'truncate'], cart()->cartItems()->first()))
            ->assertSessionHas('course_flash_msg', 'Корзина очищена');

        $this->assertDatabaseEmpty('carts');
        $this->assertDatabaseEmpty('cart_items');
    }
}