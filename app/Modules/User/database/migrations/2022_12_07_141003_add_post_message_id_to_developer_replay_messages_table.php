<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostMessageIdToDeveloperReplayMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developer_replay_messages', function (Blueprint $table) {
            $table->bigInteger('post_message_id')->unsigned()->nullable();
            $table->foreign('post_message_id')->references('id')->on('post_messages')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developer_replay_messages', function (Blueprint $table) {
            //
        });
    }
}