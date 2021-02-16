<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->text('biography')->nullable();

            $table->integer('telephone_country_id')->nullable();
            //$table->foreign('telephone_country_id')->references('id')->on('countries')->onDelete('set null')->onUpdate('cascade');
            
            $table->string('telephone');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();

            $table->integer('whatsapp_country_id')->nullable();
            //$table->foreign('whatsapp_country_id')->references('id')->on('countries')->onDelete('set null')->onUpdate('cascade');
            
            $table->string('whatsapp')->nullable();
            $table->text('telegram')->nullable();
            $table->text('website')->nullable();

            $table->enum('status',['PUBLIC', 'PRIVATE'])->default('PUBLIC');

            $table->unsignedBigInteger('user_id')->unique()->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('profiles');
    }
}
