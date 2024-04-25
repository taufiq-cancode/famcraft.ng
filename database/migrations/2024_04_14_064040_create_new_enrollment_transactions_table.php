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
        Schema::create('new_enrollment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->integer('price')->nullable();
            $table->enum('type',['adult','child']);
            $table->string('surname');
            $table->string('firstname');
            $table->string('middlename');
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->string('country_of_birth');
            $table->string('nationality');
            $table->string('nin')->nullable();
            $table->string('town');
            $table->string('country_of_residence');
            $table->string('state_of_residence');
            $table->string('lga_of_residence');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('country_of_origin')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->integer('height');
            $table->string('parent_surname')->nullable();
            $table->string('parent_firstname')->nullable();
            $table->string('parent_nin')->nullable();
            $table->string('image');
            $table->json('left_4_fingers');
            $table->json('right_4_fingers');
            $table->json('thumb_2_fingers');
            $table->string('tracking_id')->nullable();
            $table->string('response')->nullable();
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
        Schema::dropIfExists('new_enrollment_transactions');
    }
};
