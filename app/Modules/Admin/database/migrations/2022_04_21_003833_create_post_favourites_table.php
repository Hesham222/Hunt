<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_favourites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('CASCADE');
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
        Schema::dropIfExists('post_favourites');
    }
}
