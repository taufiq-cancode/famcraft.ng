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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('screenshot')->nullable();
            $table->enum('payment_type', ['manual-transfer','online-gateway'])->nullable();
            $table->string('trxref')->nullable()->change();
            $table->string('reference')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('screenshot');
            $table->dropColumn('payment_type');
            $table->string('trxref')->change();
            $table->string('reference')->change();
        });
    }
};
