<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->enum('identification_type',['IDENTIFICATION', 'PASSPORT'])->default('IDENTIFICATION')->nullable();
            $table->string('identification')->nullable();
            $table->string('identification_exp')->nullable();
            $table->string('identification_obverse_path')->nullable();
            $table->string('identification_back_path')->nullable();
            $table->string('telephone')->nullable();
            $table->string('telephone_movil')->nullable();
            $table->string('email')->nullable();

            $table->text('address')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latigude')->nullable();
            $table->string('locality')->nullable();

            $table->string('face_path')->nullable();
            $table->text('address_document_path')->nullable();
            $table->enum('marital_status',['SINGLE', 'MARRIED', 'WIDOWER'])->default('SINGLE')->nullable();
            $table->enum('gender',['MEN', 'WOMAN'])->default('MEN');

            $table->text('reference_contact')->nullable();

            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null')->onUpdate('cascade');

            $table->string('bank_account_number')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('set null')->onUpdate('cascade');

            $table->enum('status',['UNVERIFIED', 'VERIFIED'])->default('UNVERIFIED')->nullable();
            $table->text('search')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_information');
    }
}
