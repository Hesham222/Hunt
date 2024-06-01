<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingReasonTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_reason_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('listing_reason_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['listing_reason_id', 'locale']);
            $table->foreign('listing_reason_id')->references('id')->on('listing_reasons')->onDelete('cascade');
            $table->string('reason');
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
        Schema::dropIfExists('listing_reason_translations');
    }
}
