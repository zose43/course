<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        // TODO make json props
        Schema::table('products', static function (Blueprint $table) {
            $table->jsonb('json_properties')
                ->nullable();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::table('products', static function (Blueprint $table) {
                $table->dropColumn('json_properties');
            });
        }
    }
};