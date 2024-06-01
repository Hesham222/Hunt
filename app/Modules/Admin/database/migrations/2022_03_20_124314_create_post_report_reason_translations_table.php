<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostReportReasonTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_r_reason_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_report_reason_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['post_report_reason_id', 'locale']);
            $table->foreign('post_report_reason_id')->references('id')->on('post_report_reasons')->onDelete('cascade');
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
        Schema::dropIfExists('post_r_reason_translations');
    }
}
