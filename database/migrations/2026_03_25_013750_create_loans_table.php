<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_number')->unique();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('member_id');
            $table->date('loan_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->enum('status', ['active', 'returned', 'overdue'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('book_id')
                  ->references('id')
                  ->on('books')
                  ->onDelete('cascade');

            $table->foreign('member_id')
                  ->references('id')
                  ->on('members')
                  ->onDelete('cascade');

            $table->index('loan_number');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
