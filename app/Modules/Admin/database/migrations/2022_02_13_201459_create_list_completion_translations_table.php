<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListCompletionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_completion_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('listing_completion_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['listing_completion_id', 'locale']);
            $table->foreign('listing_completion_id')->references('id')->on('listing_completions')->onDelete('cascade');
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
        Schema::dropIfExists('list_completion_translations');
    }
}
