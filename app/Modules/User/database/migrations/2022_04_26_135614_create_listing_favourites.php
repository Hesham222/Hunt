<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingFavourites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_favourites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('CASCADE');
            $table->bigInteger('individual_id')->unsigned();
            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('CASCADE');
            $table->softDeletes();
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
        Schema::dropIfExists('listing_favourites');
    }
}
