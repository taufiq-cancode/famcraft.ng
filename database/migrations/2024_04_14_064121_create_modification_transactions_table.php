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
        Schema::create('modification_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->integer('price')->nullable();
            $table->string('nin');
            $table->string('tracking_id');
            $table->enum('modification_type',['name','dob','name_dob','others']);
            $table->json('details_to_modify')->nullable();
            $table->string('surname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('title')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('phone')->nullable();
            $table->string('state_of_residence')->nullable();
            $table->string('lga_of_residence')->nullable();
            $table->string('town')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('profession')->nullable();
            $table->string('passport')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->enum('religion', ['Christianity', 'Islam', 'others'])->nullable();
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
        Schema::dropIfExists('modification_transactions');
    }
};
