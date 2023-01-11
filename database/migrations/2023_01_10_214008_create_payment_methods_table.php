<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_methods', static function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('redirect_to_pay')
                ->default(false);

            $table->timestamps();
        });

        DB::table('payment_methods')
            ->insert([
                ['title' => 'Наличными'],
                ['title' => 'Онлайн', 'redirect_to_pay' => true],
            ]);
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('payment_methods');
        }
    }
};