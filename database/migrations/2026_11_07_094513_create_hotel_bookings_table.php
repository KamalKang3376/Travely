
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();

            $table->string('booking_reference')->unique();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('hotel_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 20)->nullable();

            $table->date('check_in');
            $table->date('check_out');

            $table->unsignedSmallInteger('guests')->default(1);
            $table->unsignedSmallInteger('rooms')->default(1);

            $table->decimal('price_per_night', 10, 2);
            $table->decimal('total_price', 10, 2);

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_bookings');
    }
};
