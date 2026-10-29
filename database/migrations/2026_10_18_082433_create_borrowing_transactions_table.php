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
        Schema::create('borrowing_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID sa estudyante o user nga nanghulam
            $table->unsignedBigInteger('equipment_id'); // ID sa sports equipment nga gihulam
            $table->integer('quantity')->default(1); // Kadaghanon sa gihulam
            $table->dateTime('borrowed_date'); // Petsa ug oras sa paghulam
            $table->dateTime('due_date'); // Gitakdang petsa sa pag-uli
            $table->dateTime('returned_date')->nullable(); // Petsa ug oras sa pag-uli (pwede walay sulod sa pagsugod)
            $table->enum('status', ['Borrowed', 'Returned', 'Overdue'])->default('Borrowed'); // Kahimtang sa transaksiyon
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_transactions');
    }
};