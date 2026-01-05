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
        Schema::create('tb_orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->unsignedBigInteger('id_user');
            $table->string('order_number')->unique(); // Format: ORD-YYYYMMDD-XXXXX
            $table->decimal('total_amount', 15, 2);
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled', 'expired'])->default('pending');
            $table->enum('payment_type', ['credit_card', 'bank_transfer', 'e-wallet', 'qris', 'other'])->nullable();
            
            // Midtrans transaction data
            $table->string('snap_token')->nullable();
            $table->string('transaction_id')->nullable()->unique();
            $table->timestamp('transaction_time')->nullable();
            $table->text('payment_response')->nullable(); // Store JSON response from Midtrans
            
            $table->timestamps();
            
            $table->foreign('id_user')->references('id_user')->on('tb_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_orders');
    }
};
