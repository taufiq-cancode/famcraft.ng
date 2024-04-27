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
        Schema::create('pricing_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('duration');
            $table->timestamps();
        });

        $pricing_categories = [
            ['name' => 'Modification', 'duration' => '48-96 Hours'],
            ['name' => 'Verification', 'duration' => 'Instantly'],
            ['name' => 'IPE Clearance', 'duration' => '48 Hours'],
            ['name' => 'Validation', 'duration' => '48-96 Hours'],
            ['name' => 'Name Modification IPE Clearance and Validation', 'duration' => '48-96 Hours'],
            ['name' => 'DOB Modification IPE Clearance and Validation', 'duration' => '48-96 Hours'],
            ['name' => 'NIN Enrollment', 'duration' => '24-48 Hours'],
            ['name' => 'Personalization', 'duration' => '2-24 Hours'],
            ['name' => 'PUK Retrieval', 'duration' => '2-24 Hours'],
        ];

        foreach ($pricing_categories as $pricing_category) {
            DB::table('pricing_categories')->insert([
                'name' => $pricing_category['name'],
                'duration' => $pricing_category['duration']
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_categories');
    }
};
