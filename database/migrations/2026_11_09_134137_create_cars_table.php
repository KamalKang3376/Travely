
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
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('transmission')->default('Manual');
            $table->string('fuel_type')->default('Petrol');
            $table->integer('seats')->default(5);
            $table->decimal('price_per_day', 10, 2);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
