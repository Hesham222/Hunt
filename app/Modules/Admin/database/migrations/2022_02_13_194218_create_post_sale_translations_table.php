<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostSaleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_sale_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_sale_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['post_sale_id', 'locale']);
            $table->foreign('post_sale_id')->references('id')->on('post_sales')->onDelete('cascade');
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
        Schema::dropIfExists('post_sale_translations');
    }
}
