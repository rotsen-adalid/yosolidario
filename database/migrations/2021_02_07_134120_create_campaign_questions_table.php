<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_questions', function (Blueprint $table) {
            $table->id();
            $table->longText('about')->nullable();
            $table->longText('about_es')->nullable();
            $table->longText('about_en')->nullable();
            $table->longText('about_pt_BR')->nullable();
            $table->string('about_url')->nullable();

            $table->longText('use_of_money')->nullable();
            $table->longText('use_of_money_es')->nullable();
            $table->longText('use_of_money_en')->nullable();
            $table->longText('use_of_money_pt_BR')->nullable();
            $table->string('use_of_money_url')->nullable();

            $table->longText('about_organizer')->nullable();
            $table->longText('about_organizer_es')->nullable();
            $table->longText('about_organizer_en')->nullable();
            $table->longText('about_organizer_pt_BR')->nullable();
            $table->string('about_organizer_url')->nullable();

            $table->longText('delivery_of_awards')->nullable();
            $table->longText('delivery_of_awards_es')->nullable();
            $table->longText('delivery_of_awards_en')->nullable();
            $table->longText('delivery_of_awards_pt_BR')->nullable();
            $table->string('delivery_of_awards_url')->nullable();

            $table->text('contact_organizer')->nullable();
            $table->text('contact_organizer_es')->nullable();
            $table->text('contact_organizer_en')->nullable();
            $table->text('contact_organizer_pt_BR')->nullable();
            $table->string('contact_organizer_url')->nullable();

            $table->text('question_title_add')->nullable();
            $table->text('question_title_add_es')->nullable();
            $table->text('question_title_add_en')->nullable();
            $table->text('question_title_add_pt_BR')->nullable();
            $table->longText('question_body_add')->nullable();
            $table->longText('question_body_add_es')->nullable();
            $table->longText('question_body_add_en')->nullable();
            $table->longText('question_body_add_pt_BR')->nullable();
            $table->string('question_url_add')->nullable();
            
            $table->unsignedBigInteger('campaign_id')->unique();
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
        Schema::dropIfExists('campaign_questions');
    }
}
