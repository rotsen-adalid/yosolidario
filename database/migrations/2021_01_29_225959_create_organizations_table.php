<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('identification')->nullable();
            $table->string('identification_image')->nullable();
            $table->enum('type',['COMPANY', 'ONG', 'FOUNDATION'])->default('FOUNDATION');
            
            $table->string('address')->nullable();
            $table->string('longitude')->nullable();
            
            $table->string('latigude')->nullable();
            $table->string('locality')->nullable();

            $table->string('telephone')->nullable();
            $table->string('telephone_movil')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('references_contact')->nullable();

            $table->text('about')->nullable();
            $table->text('note')->nullable();

            $table->enum('status_organization',['UNVERIFIED', 'VERIFIED'])->default('UNVERIFIED');
            $table->enum('status_agreement',['ACTIVE', 'SUSPENDED', 'IN_PROCESS', 'INACTIVE'])->default('INACTIVE');

            $table->text('search')->nullable();

            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
