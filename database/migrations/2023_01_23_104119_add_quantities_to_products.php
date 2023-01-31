<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', static function (Blueprint $table) {
            $table->unsignedInteger('quantity')
                ->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('products', static function (Blueprint $table) {
            if (!app()->isProduction()) {
                $table->dropColumn('quantity');
            }
        });
    }
};