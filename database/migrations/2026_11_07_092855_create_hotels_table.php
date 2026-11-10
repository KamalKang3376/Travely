<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('city');
            $table->string('country');
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price_per_night', 10, 2);
            $table->decimal('rating', 2, 1)->default(0);
            $table->json('facilities')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};