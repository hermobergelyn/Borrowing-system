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
            $table->string('employee_id', 30)->nullable()->unique();
        });

        DB::table('users')
            ->select(['id', 'role', 'student_id'])
            ->whereNotNull('role')
            ->where('role', '<>', '')
            ->orderBy('id')
            ->chunkById(100, function ($users): void {
                foreach ($users as $user) {
                    $role = strtolower(trim($user->role));
                    $updates = [];

                    if ($role === 'student' && blank($user->student_id)) {
                        $updates['student_id'] = sprintf('STU-%06d', $user->id);
                    }

                    if (in_array($role, ['staff', 'pe_instructor', 'pe instructor', 'admin', 'administrator', 'sports coordinator'], true)) {
                        $updates['employee_id'] = sprintf('EMP-%06d', $user->id);
                    }

                    if ($updates !== []) {
                        DB::table('users')->where('id', $user->id)->update($updates);
                    }
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['employee_id']);
            $table->dropColumn('employee_id');
        });
    }
};
