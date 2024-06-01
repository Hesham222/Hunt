<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingStatusTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_status_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('listing_status_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['listing_status_id', 'locale']);
            $table->foreign('listing_status_id')->references('id')->on('listing_statuses')->onDelete('cascade');
            $table->string('status');
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
        Schema::dropIfExists('listing_status_translations');
    }
}
