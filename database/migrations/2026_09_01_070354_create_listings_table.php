<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('color_id')->nullable()->constrained()->nullOnDelete();
            $table->string('seller_name', 100)->default('Store');
            $table->enum('condition_type', ['new', 'used'])->default('new');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->char('currency', 3)->default('USD');
            $table->string('country', 80)->default('USA');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
