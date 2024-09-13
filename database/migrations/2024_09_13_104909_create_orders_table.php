<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending'); // e.g., pending, paid, failed
            $table->decimal('amount', 8, 2); // Amount of the order
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming you have a users table
            $table->string('payment_intent_id')->nullable(); // Stripe PaymentIntent ID
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
