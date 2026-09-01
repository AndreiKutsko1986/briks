<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('color_id')->constrained()->cascadeOnDelete();
            $table->string('image_path')->nullable();
            $table->unique(['item_id', 'color_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_colors');
    }
};
