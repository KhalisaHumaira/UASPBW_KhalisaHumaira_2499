<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_code')->unique();
            $table->string('delivery_address');
            $table->date('delivery_date');
            $table->string('delivery_time')->default('09:00');
            $table->text('note')->nullable();
            $table->integer('total_price');
            $table->enum('status', ['pending','confirmed','process','ready','delivered','cancelled'])->default('pending');
            $table->enum('payment_method', ['transfer','cod','ewallet'])->default('transfer');
            $table->enum('payment_status', ['unpaid','paid'])->default('unpaid');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};
