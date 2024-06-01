<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrokerReplayMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broker_replay_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('broker_id')->unsigned();
            $table->foreign('broker_id')->references('id')->on('brokers')->onDelete('CASCADE');
            $table->morphs('model');
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
        Schema::dropIfExists('broker_replay_messages');
    }
}
