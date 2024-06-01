<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingSaleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_sale_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('listing_sale_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['listing_sale_id', 'locale']);
            $table->foreign('listing_sale_id')->references('id')->on('listing_sales')->onDelete('cascade');
            $table->string('sale');
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
        Schema::dropIfExists('listing_sale_translations');
    }
}
