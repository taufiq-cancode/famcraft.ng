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
            $table->string('left_finger')->after('thumb_2_fingers')->nullable();
            $table->string('right_finger')->after('left_finger')->nullable();
            $table->string('thumb_finger')->after('right_finger')->nullable();
            $table->dropColumn(['left_4_fingers', 'right_4_fingers', 'thumb_2_fingers']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('new_enrollment_transactions', function (Blueprint $table) {
            $table->json('left_4_fingers')->nullable();
            $table->json('right_4_fingers')->nullable();
            $table->json('thumb_2_fingers')->nullable();
            $table->dropColumn(['left_finger', 'right_finger', 'thumb_finger']);
        });
    }
};
