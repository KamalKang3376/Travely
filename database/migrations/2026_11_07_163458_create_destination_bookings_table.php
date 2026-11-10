
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destination_bookings', function (Blueprint $table) {
            $table->id();

            $table->string('booking_reference')->unique();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('destination_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 20)->nullable();

            $table->date('start_date');
            $table->date('end_date');

            $table->unsignedSmallInteger('travellers')->default(1);

            $table->decimal('price_per_person', 10, 2);
            $table->decimal('total_price', 10, 2);

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destination_bookings');
    }
};
