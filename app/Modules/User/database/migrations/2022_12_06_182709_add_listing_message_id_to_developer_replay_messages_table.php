<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddListingMessageIdToDeveloperReplayMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developer_replay_messages', function (Blueprint $table) {
            $table->bigInteger('listing_message_id')->unsigned()->nullable();
            $table->foreign('listing_message_id')->references('id')->on('listing_messages')->onDelete('CASCADE');
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
