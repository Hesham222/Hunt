<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountReportReasonTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_r_reason_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_report_reason_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['account_report_reason_id', 'locale']);
            $table->foreign('account_report_reason_id')->references('id')->on('account_report_reasons')->onDelete('cascade');
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
        Schema::dropIfExists('acc_r_reason_translations');
    }
}
