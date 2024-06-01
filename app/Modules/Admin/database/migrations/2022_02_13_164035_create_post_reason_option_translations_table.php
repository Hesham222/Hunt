<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostReasonOptionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_option_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_reason_option_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['post_reason_option_id', 'locale']);
            $table->foreign('post_reason_option_id')->references('id')->on('post_reason_options')->onDelete('cascade');
            $table->string('option');
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
        Schema::dropIfExists('post_option_translations');
    }
}
