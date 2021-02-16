<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignRecognitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_recognitions', function (Blueprint $table) {
            $table->id();
            $table->string('image_url')->nullable();
            $table->decimal('amount')->nullable();
            $table->text('description')->nullable();
            $table->text('description_es')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_pt_BR')->nullable();
            $table->date('delivery_date', 20)->nullable();
            $table->enum('limiter',['YES', 'NO'])->default('YES');
            $table->integer('quantity')->nullable();

            $table->integer('collaborators')->nullable();

            $table->unsignedBigInteger('campaign_id');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('campaign_recognitions');
    }
}
