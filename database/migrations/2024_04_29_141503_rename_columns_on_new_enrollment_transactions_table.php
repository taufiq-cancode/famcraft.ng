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
        Schema::table('new_enrollment_transactions', function (Blueprint $table) {
            $table->renameColumn('left_4_fingers', 'left_finger');
            $table->renameColumn('thumb_2_fingers', 'thumb_finger');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('new_enrollment_transactions', function (Blueprint $table) {
            $table->renameColumn('left_finger', 'left_4_fingers');
            $table->renameColumn('thumb_finger', 'thumb_2_fingers');
        });
    }
};
