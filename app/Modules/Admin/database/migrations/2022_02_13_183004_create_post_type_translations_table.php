<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_type_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_type_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['post_type_id', 'locale']);
            $table->foreign('post_type_id')->references('id')->on('post_types')->onDelete('cascade');
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
        Schema::dropIfExists('post_type_translations');
    }
}
