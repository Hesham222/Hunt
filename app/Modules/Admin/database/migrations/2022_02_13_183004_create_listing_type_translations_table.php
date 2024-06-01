<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_type_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('listing_type_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['listing_type_id', 'locale']);
            $table->foreign('listing_type_id')->references('id')->on('listing_types')->onDelete('cascade');
            $table->string('type');
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
        Schema::dropIfExists('listing_type_translations');
    }
}
