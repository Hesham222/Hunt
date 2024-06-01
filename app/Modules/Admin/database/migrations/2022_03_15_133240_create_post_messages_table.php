<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('individual_id')->unsigned()->nullable();
            $table->foreign('individual_id')->references('id')->on('individuals');
            $table->bigInteger('broker_id')->unsigned()->nullable();
            $table->foreign('broker_id')->references('id')->on('brokers');
            $table->bigInteger('developer_id')->unsigned()->nullable();
            $table->foreign('developer_id')->references('id')->on('developers');
            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->string('title');
            $table->text('message');
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
        Schema::dropIfExists('post_messages');
    }
}
