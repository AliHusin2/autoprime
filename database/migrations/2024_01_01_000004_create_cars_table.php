<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('model')->nullable();
            $table->unsignedSmallInteger('year');
            $table->unsignedBigInteger('price');
            $table->enum('transmission', ['manual', 'automatic'])->default('manual');
            $table->string('fuel_type')->default('bensin');
            $table->unsignedInteger('mileage')->default(0);
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'sold'])->default('available');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
