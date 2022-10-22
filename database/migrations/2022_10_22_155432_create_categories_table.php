<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', static function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // TODO 3rd lesson
        if (app()->isLocal()) {
            Schema::dropIfExists('categories');
        }
    }
};
