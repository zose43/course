<?php

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', static function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->unsignedInteger('price')->default(0);
            $table->string('title');
            $table->timestamps();

            $table->foreignIdFor(Brand::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::create('category_product', static function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Category::class)->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignIdFor(Product::class)->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('category_product');
            Schema::dropIfExists('products');
        }
    }
};
