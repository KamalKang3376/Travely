<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('packages', function (Blueprint $table) {
        $table->id();

        $table->string('name');
        $table->string('slug')->unique();
        $table->string('destination');
        $table->string('category')->default('Adventure');

        $table->integer('duration_days');
        $table->integer('duration_nights');

        $table->decimal('price', 10, 2);
        $table->decimal('discount_price', 10, 2)->nullable();

        $table->string('image')->nullable();
        $table->text('description')->nullable();

        $table->json('highlights')->nullable();
        $table->json('inclusions')->nullable();
        $table->json('exclusions')->nullable();

        $table->integer('max_people')->default(10);
        $table->boolean('featured')->default(false);
        $table->boolean('status')->default(true);

        $table->timestamps();
    });
}
    
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
