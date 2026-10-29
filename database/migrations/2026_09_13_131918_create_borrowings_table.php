<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Student who borrowed
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade'); // Equipment borrowed
            $table->integer('quantity');
            $table->dateTime('borrowed_date');
            $table->dateTime('return_date')->nullable();
            $table->string('status')->default('Pending'); // Pending, Approved, Returned, Overdue
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};