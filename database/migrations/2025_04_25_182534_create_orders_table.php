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
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->string('regarding')->nullable();
            $table->date('order_date');
            $table->enum('status', ['pending', 'processed', 'verified', 'validated', 'approved', 'rejected']);
            $table->foreignId('processed')->nullable();
            $table->foreignId('verified')->nullable();
            $table->foreignId('validated')->nullable();
            $table->foreignId('approved')->nullable();
            $table->foreignId('rejected')->nullable();
            $table->string('note')->nullable();
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
