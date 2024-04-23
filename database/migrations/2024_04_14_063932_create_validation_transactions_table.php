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
        Schema::create('validation_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nin');
            $table->enum('validation_category', ['no-record-found', 'update-record', 'validation-modification', 'v-nin-validation', 'photograph-error', 'by-pass-nin']);
            $table->enum('validation_purpose', ['bank', 'sim', 'passport', 'others']);
            $table->string('response')->nullable();
            $table->enum('status', ['pending', 'invalidated', 'completed', 'failed', 'bvn-nin', 'others'])->default('pending');
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
        Schema::dropIfExists('validation_transactions');
    }
};
