<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestedCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interested_comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('CASCADE');
            $table->morphs('model');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('interested_comments');
    }
}
