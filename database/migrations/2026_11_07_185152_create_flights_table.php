
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();

            $table->string('airline');
            $table->string('flight_number')->unique();

            $table->string('departure_city');
            $table->string('arrival_city');

            $table->string('departure_airport')->nullable();
            $table->string('arrival_airport')->nullable();

            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');

            $table->decimal('price', 10, 2);
            $table->unsignedInteger('total_seats')->default(100);
            $table->unsignedInteger('available_seats')->default(100);

            $table->string('travel_class')->default('Economy');

            $table->string('image')->nullable();
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index(['departure_city', 'arrival_city']);
            $table->index('departure_time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
