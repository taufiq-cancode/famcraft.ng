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
        Schema::table('verification_transactions', function (Blueprint $table) {
            $table->enum('slip_type', [
                'premium-slip',
                'standard-slip',
                'improved-nin-slip',
                'basic-slip',
                'nvs-slip'
            ])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('verification_transactions', function (Blueprint $table) {
            $table->enum('slip_type', [
                'premium-slip',
                'standard-slip',
                'improved-nin-slip',
                'basic-slip'
            ])->change();
        });
    }
};
