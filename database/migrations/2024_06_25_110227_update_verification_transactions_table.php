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
            $table->enum('verification_type', ['v1', 'v2'])->default('v1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('verification_transactions', function (Blueprint $table) {
            $table->dropColumn('verification_type');
        });
    }
};
