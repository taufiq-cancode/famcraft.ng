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
        Schema::create('p_u_k_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('fullname');
            $table->date('dob');
            $table->integer('amount');
            $table->enum('status', ['success', 'pending', 'failed'])->default('pending');
            $table->string('response')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_u_k_transactions');
    }
};
