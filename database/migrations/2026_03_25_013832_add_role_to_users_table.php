<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'librarian', 'member'])->default('member')->after('password');
            $table->unsignedBigInteger('member_id')->nullable()->after('role');
            
            $table->foreign('member_id')
                  ->references('id')
                  ->on('members')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->dropColumn(['role', 'member_id']);
        });
    }
};