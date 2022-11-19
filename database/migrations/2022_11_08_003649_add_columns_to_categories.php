<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('categories', static function (Blueprint $table) {
            $table->boolean('on_main_page')->default(false);
            $table->integer('sorting')->default(999);
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::table('categories', static function (Blueprint $table) {
                $table->dropColumn(['sorting', 'on_main_page']);
            });
        }
    }
};
