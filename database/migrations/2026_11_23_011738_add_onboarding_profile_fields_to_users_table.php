<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('department', 120)->nullable();
            $table->string('student_id', 60)->nullable();
            $table->string('course_section', 80)->nullable();
            $table->timestamp('profile_completed_at')->nullable();
        });

        DB::table('users')
            ->whereNotNull('role')
            ->where('role', '<>', '')
            ->update(['profile_completed_at' => now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'phone',
                'department',
                'student_id',
                'course_section',
                'profile_completed_at',
            ]);
        });
    }
};
