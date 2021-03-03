<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();

            $table->text('title');
            $table->text('title_es')->nullable();
            $table->text('title_en')->nullable();
            $table->text('title_pt_BR')->nullable();
            $table->string('slug')->unique();
            $table->text('extract', 200)->nullable();
            $table->text('extract_es', 200)->nullable();
            $table->text('extract_en', 200)->nullable();
            $table->text('extract_pt_BR', 200)->nullable();
            $table->enum('type_campaign', ['PERSONAL','ORGANIZATION'])->default('PERSONAL');

            $table->enum('period',  [10,15,30,45,60,90])->default(60);

            // contadores
            $table->integer('views')->nullable();
            $table->integer('shareds')->nullable();
            $table->integer('followers')->nullable();

            // ubication
            $table->text('locality')->nullable();
            
            $table->integer('telephone');

            $table->enum('status', ['DRAFT','IN_REVIEW', 'PUBLISHED', 'INACTIVE'])->default('DRAFT');
            $table->enum('status_register', ['INCOMPLETE','COMPLETE'])->default('INCOMPLETE');
            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_campaign_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('agency_id')->nullable();

            $table->text('search')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('category_campaign_id')->references('id')->on('category_campaigns')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('set null')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}