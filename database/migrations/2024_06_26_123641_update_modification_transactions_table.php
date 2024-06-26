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
        Schema::table('modification_transactions', function (Blueprint $table) {
            $table->enum('modification_type', ['name', 'dob', 'name_dob', 'others', 'name_others', 'dob_others', 'suspended_bvn', 'new_enrollment_old_slip'])->change();
            $table->string('old_nin');
            $table->string('nin')->nullable()->change();
            $table->string('tracking_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modification_transactions', function (Blueprint $table) {
            $table->enum('modification_type', ['name', 'dob', 'name_dob', 'others', 'name_others', 'dob_others', 'suspended_bvn'])->change();
            $table->dropColumn('old_nin');
            $table->string('nin')->change();
            $table->string('tracking_id')->change();
        });
    }
};
