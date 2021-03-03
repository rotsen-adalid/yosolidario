<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignCollectedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_collecteds', function (Blueprint $table) {
            $table->id();
            $table->integer('collaborators')->nullable();
            $table->decimal('amount_target')->nullable();
            $table->decimal('amount_collected')->nullable();
            $table->decimal('amount_percentage_collected')->nullable();
            $table->date('last_deposit', 20)->nullable();
            $table->unsignedBigInteger('campaign_id');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade')->onUpdate('cascade');
            
            $table->enum('status', ['INACTIVE','IN_COLLECTION','COLLECTION_CLOSING','COLLECTION_FINALIZED'])->default('INACTIVE');
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
        Schema::dropIfExists('campaign_collecteds');
    }
}
