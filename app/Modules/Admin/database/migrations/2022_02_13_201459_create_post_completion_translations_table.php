<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCompletionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_completion_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_completion_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['post_completion_id', 'locale']);
            $table->foreign('post_completion_id')->references('id')->on('post_completions')->onDelete('cascade');
            $table->string('completion');
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
        Schema::dropIfExists('post_completion_translations');
    }
}
