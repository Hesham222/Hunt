<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrokerReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broker_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('broker_id')->unsigned();
            $table->foreign('broker_id')->references('id')->on('brokers')->onDelete('CASCADE');
            $table->morphs('model');
            $table->enum('rate',[1,2,3,4,5]);
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
        Schema::dropIfExists('broker_reviews');
    }
}
