<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {

            if (!Schema::hasColumn('members', 'password')) {
                $table->string('password')->nullable()->after('email');
            }

            if (!Schema::hasColumn('members', 'remember_token')) {
                $table->string('remember_token', 100)->nullable()->after('password');
            }

        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['password', 'remember_token']);
        });
    }
};
