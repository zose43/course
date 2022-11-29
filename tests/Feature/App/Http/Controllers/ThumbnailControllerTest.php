<?php

namespace Tests\Feature\App\Http\Controllers;

use Storage;
use Tests\TestCase;
use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Database\Factories\BrandFactory;
use Database\Factories\ProductFactory;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @coversDefaultClass ThumbnailController
 */
class ThumbnailControllerTest extends TestCase
{
    // TODO mock Image, more tests
    use RefreshDatabase;

    private Product $product;
    private Brand $brand;
    private Filesystem $storage;

    private function getRequest(Product|Brand $model, string $method = 'resize', string $size = '70x70'): array
    {
        $dir = $model instanceof Brand ? 'brands' : 'products';

        return [
            'method' => $method,
            'file' => basename($model->thumbnail),
            'size' => $size,
            'dir' => $dir,
        ];
    }

    private function directory(array $request): string
    {
        $dir = $request['dir'] . '/';
        $dir .= $request['method'] . '/';
        $dir .= $request['size'] . '/' . $request['file'];

        return $dir;
    }

    protected function setUp(): void
    {
        parent::setUp();

        ProductFactory::new()
            ->count(1)
            ->create();
        BrandFactory::new()
            ->count(1)
            ->create();

        $this->product = Product::first();
        $this->brand = Brand::first();
        $this->storage = Storage::disk('images');
    }

    /**
     * @test
     */
    public function is_thumbnail_create_success_brand(): void
    {
        $request = $this->getRequest($this->brand);
        $response = $this->get(action([ThumbnailController::class], $request));
        $file = $this->directory($request);

        $response->assertOk();
        $this->storage
            ->exists($file);
    }

    /**
     * @test
     */
    public function is_thumbnail_create_success_product(): void
    {
        $request = $this->getRequest($this->product, size: '345x320');
        $response = $this->get(action([ThumbnailController::class], $request));
        $file = $this->directory($request);

        $response->assertOk();
        $this->storage
            ->exists($file);
    }

    /**
     * @test
     */
    public function is_image_size_not_allowed(): void
    {
        $request = $this->getRequest($this->brand, size: '120x120');
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Size not allowed');

        $this->withoutExceptionHandling()
            ->get(action([ThumbnailController::class], $request));
    }
}