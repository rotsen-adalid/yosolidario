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
            $table->string('name', 100);
            $table->string('last_name', 100);
            $table->enum('identification_type',['IDENTIFICATION', 'PASSPORT'])->default('IDENTIFICATION');
            $table->string('identification',100);

            $table->unsignedBigInteger('user_id')->unique()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            
            $table->string('telephone')->nullable();
            $table->string('telephone_movil')->nullable();
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
