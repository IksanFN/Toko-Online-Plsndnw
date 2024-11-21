<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
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
        Schema::disableForeignKeyConstraints();

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code');
            $table->foreignId('user_id')->constrained();
            $table->bigInteger('total_amount');
            $table->string('order_status')->default(OrderStatus::WAITING);
            $table->string('payment_status')->default(PaymentStatus::UNPAID);
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('order_date');
            $table->string('payment_method')->default(PaymentMethod::TRANSFER);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
