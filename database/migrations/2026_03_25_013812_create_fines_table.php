<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->decimal('amount', 8, 2);
            $table->decimal('paid_amount', 8, 2)->default(0);
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->text('reason')->nullable();
            $table->timestamps();
            
            $table->foreign('loan_id')
                  ->references('id')
                  ->on('loans')
                  ->onDelete('cascade');
            
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};