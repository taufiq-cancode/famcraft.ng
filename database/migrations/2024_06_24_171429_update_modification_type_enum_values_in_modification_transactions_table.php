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
            $table->enum('modification_type', ['name', 'dob', 'name_dob', 'others', 'name_others', 'dob_others', 'suspended_bvn'])->change();
            $table->string('lga_of_origin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modification_transactions', function (Blueprint $table) {
            DB::table('modification_transactions')
                ->whereNotIn('modification_type', ['name', 'dob', 'name_dob', 'others'])
                ->update(['modification_type' => 'others']);
            
            $table->enum('modification_type', ['name', 'dob', 'name_dob', 'others'])->change();
            $table->dropColumn('lga_of_origin');
        });
    }
};
