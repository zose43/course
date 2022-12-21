<?php

use Domain\Cart\Models\CartItem;
use Illuminate\Support\Facades\Schema;
use Domain\Product\Models\OptionValue;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_item_potion_value', static function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(CartItem::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(OptionValue::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('cart_item_potion_value');
        }
    }
};