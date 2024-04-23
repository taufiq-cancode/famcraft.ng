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
        Schema::create('verification_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('method', ['by-demographics', 'by-phone', 'by-nin']);
            $table->string('surname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone')->nullable();
            $table->integer('nin')->nullable();
            $table->enum('slip_type', ['premium-slip', 'standard-slip', 'improved-nin-slip', 'basic-slip']);
            $table->string('response')->nullable();
            $table->enum('status', ['pending', 'success', 'completed', 'failed', 'others'])->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_transactions');
    }
};
