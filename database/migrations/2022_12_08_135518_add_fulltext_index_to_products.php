<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', static function (Blueprint $table) {
            $table->text('text')->
            nullable();

            $table->fullText(['title', 'text']);
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::table('products', static function (Blueprint $table) {
                $table->dropIndex('products_title_text_fulltext');
                $table->dropColumn('text');
            });
        }
    }
};