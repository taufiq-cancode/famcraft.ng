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
        Schema::create('i_p_e_clearance_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->integer('price')->nullable();
            $table->enum('ipe_category', ['in-processing-error', 'still-in-process', 'new-enrollment-for-old-tracking-id']);
            $table->string('tracking_id');
            $table->string('response')->nullable();
            $table->json('response_pdf')->nullable();
            $table->string('response_text')->nullable();
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
        Schema::dropIfExists('i_p_e_clearance_transactions');
    }
};
