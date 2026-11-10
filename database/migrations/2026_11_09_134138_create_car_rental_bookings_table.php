
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_rental_bookings', function (Blueprint $table) {
            $table->id();

            $table->string('booking_reference')->unique();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('car_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');

            $table->dateTime('pickup_datetime');
            $table->dateTime('return_datetime');

            $table->string('pickup_location');
            $table->string('dropoff_location');

            $table->integer('rental_days');

            $table->decimal('price_per_day', 10, 2);
            $table->decimal('total_price', 10, 2);

            $table->enum('status', [
                'pending',
                'confirmed',
                'cancelled',
                'completed'
            ])->default('pending');

            $table->timestamps();

            $table->index(['car_id', 'pickup_datetime', 'return_datetime']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_rental_bookings');
    }
};
