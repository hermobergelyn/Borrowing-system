<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Basketball, Badminton Racket
            $table->string('category'); // e.g., Balls, Rackets
            $table->integer('total_quantity');
            $table->integer('available_quantity');
            $table->string('status')->default('Available'); // Available, Out of Stock, Maintenance
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};