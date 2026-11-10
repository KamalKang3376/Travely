
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id();

            $table->string('booking_reference')->unique();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('flight_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');

            $table->unsignedInteger('passengers');

            $table->decimal('price_per_seat', 10, 2);
            $table->decimal('total_price', 10, 2);

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flight_bookings');
    }
};
