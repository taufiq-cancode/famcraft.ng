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
            $table->enum('slup_type', ['premium-slip', 'standard-slip', 'improved-nin-slip', 'basic-slip']);
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->foreign('agent_id')->references('id')->on('users');
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
