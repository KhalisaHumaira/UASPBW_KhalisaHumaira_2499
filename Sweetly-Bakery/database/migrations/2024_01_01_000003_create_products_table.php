<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->string('emoji')->default('🎂');
            $table->string('bg_color')->default('#fdf2f8');
            $table->integer('stock')->default(10);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_custom_order')->default(false); // bisa custom order
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('products'); }
};
