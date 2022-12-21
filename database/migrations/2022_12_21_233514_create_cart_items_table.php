<?php

use Domain\Cart\Models\Cart;
use Domain\Product\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_items', static function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Cart::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(Product::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unsignedInteger('price');
            $table->unsignedInteger('quantity')
                ->default(1);
            $table->string('string_option_values')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('cart_items');
        }
    }
};