<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('brands', static function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('brands');
        }
    }
};
