<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeveloperReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('developer_id')->unsigned();
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('CASCADE');
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
        Schema::dropIfExists('developer_reviews');
    }
}
