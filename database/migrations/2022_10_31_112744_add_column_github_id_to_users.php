<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', static function (Blueprint $table) {
            $table->string('github_id')->nullable();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::table('users', static function (Blueprint $table) {
                $table->dropColumn('github_id');
            });
        }
    }
};