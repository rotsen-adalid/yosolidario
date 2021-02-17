<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('denomination', 100);
            $table->string('slug')->unique()->nullable();
            $table->string('identification')->nullable();
            $table->string('identification_image')->nullable();
            $table->text('addresses')->nullable();
            $table->string('email_contact')->unique();
            $table->text('representative')->nullable();

            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null')->onUpdate('cascade');
            
            $table->enum('type',['MATRIX_HOUSE', 'AGENCY'])->default('AGENCY');
            $table->enum('status',['ACTIVE', 'INACTIVE'])->default('ACTIVE');

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
        Schema::dropIfExists('agencies');
    }
}
