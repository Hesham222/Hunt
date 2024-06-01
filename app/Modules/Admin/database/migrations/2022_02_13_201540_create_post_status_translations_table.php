<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostStatusTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_status_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_status_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['post_status_id', 'locale']);
            $table->foreign('post_status_id')->references('id')->on('post_statuses')->onDelete('cascade');
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
        Schema::dropIfExists('post_status_translations');
    }
}
