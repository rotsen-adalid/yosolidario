<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('organization_id')->unique();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('organization_representative');
            
            $table->string('yosolidario_representative');
            $table->string('date_signed');
            $table->text('note')->nullable();
            $table->enum('status_agreement',['ACTIVE', 'SUSPENDED'])->default('SUSPENDED');
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
        Schema::dropIfExists('agreements');
    }
}
