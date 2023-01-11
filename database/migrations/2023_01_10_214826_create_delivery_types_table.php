<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_types', static function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedInteger('price')
                ->default(0);
            $table->boolean('with_address')
                ->default(false);

            $table->timestamps();
        });

        DB::table('delivery_types')
            ->insert([
                ['title' => "Самовывоз"],
                ['title' => 'Курьером', 'with_address' => true],
            ]);
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('delivery_types');
        }
    }
};