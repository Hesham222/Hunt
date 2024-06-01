<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('individual_id')->unsigned()->nullable();
            $table->foreign('individual_id')->references('id')->on('individuals');
            $table->bigInteger('broker_id')->unsigned()->nullable();
            $table->foreign('broker_id')->references('id')->on('brokers');
            $table->bigInteger('developer_id')->unsigned()->nullable();
            $table->foreign('developer_id')->references('id')->on('developers');
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('id')->on('listings');
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
        Schema::dropIfExists('listing_messages');
    }
}
