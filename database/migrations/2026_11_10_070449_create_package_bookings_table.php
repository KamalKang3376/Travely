<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('package_bookings', function (Blueprint $table) {
        $table->id();

        $table->string('booking_reference')->unique();

        $table->foreignId('package_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->foreignId('user_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->string('package_name');
        $table->string('destination');

        $table->string('customer_name');
        $table->string('customer_email');
        $table->string('customer_phone');

        $table->date('travel_date');
        $table->unsignedInteger('travellers');

        $table->decimal('price_per_person', 10, 2);
        $table->decimal('total_amount', 10, 2);

        $table->text('special_request')->nullable();

        $table->enum('status', [
            'pending',
            'confirmed',
            'cancelled'
        ])->default('pending');

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('package_bookings');
    }
};
