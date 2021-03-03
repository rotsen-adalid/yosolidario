<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique()->nullable();
            $table->string('name_icon')->unique();
            $table->enum('type',['PROJECT', 'SOCIAL_IMPACT'])->default('SOCIAL_IMPACT');
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
        Schema::dropIfExists('category_campaigns');
    }
}
