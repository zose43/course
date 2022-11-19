<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use Database\Factories\BrandFactory;
use Database\Factories\ProductFactory;
use Database\Factories\CategoryFactory;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @coversDefaultClass HomeController
 */
class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        ProductFactory::new()->onMainPage()->sorting(999)->create();
        CategoryFactory::new()->onMainPage()->sorting(999)->create();
        BrandFactory::new()->onMainPage()->sorting(999)->create();
    }

    /**
     * @test
     */
    public function is_success_response(): void
    {
        $product = ProductFactory::new()->onMainPage()->sorting(1)->create();
        $category = CategoryFactory::new()->onMainPage()->sorting(1)->create();
        $brand = BrandFactory::new()->onMainPage()->sorting(1)->create();

        $this->get(action([HomeController::class]))
            ->assertOk()
            ->assertViewHas([
                'products.0' => $product,
                'brands.0' => $brand,
                'categories.0' => $category,
            ]);
    }
}