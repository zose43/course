<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_histories', static function (Blueprint $table) {
            $table->id();
            $table->string('payment_gateway');
            $table->string('method')
                ->nullable();
            $table->json('payload')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('payment_histories');
        }
    }
};