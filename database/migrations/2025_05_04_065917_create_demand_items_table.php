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
        Schema::create('demand_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demand_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->integer('price')->nullable(); // Add the price column
            $table->integer('total')->nullable(); // Add the total column for the resul
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demand_items');
    }
};
