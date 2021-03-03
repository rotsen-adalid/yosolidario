<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignOpeningRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_opening_requests', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->nullable();
            $table->dateTime('date_send')->nullable();
            $table->dateTime('date_revised')->nullable();
            $table->text('data_campaign')->nullable();
            $table->text('data_personal_information')->nullable();
            $table->text('suggestions')->nullable();
            $table->text('observations')->nullable();

            $table->enum('status', ['APPROVED','REJECTED', 'CURRENT'])->default('CURRENT');

            $table->unsignedBigInteger('user_reviewer_id')->nullable();
            $table->unsignedBigInteger('campaign_id');
            $table->foreign('user_reviewer_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('campaign_opening_requests');
    }
}
