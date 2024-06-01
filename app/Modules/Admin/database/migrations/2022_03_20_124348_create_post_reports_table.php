<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('individual_id')->unsigned()->nullable();
            $table->foreign('individual_id')->references('id')->on('individuals');
            $table->bigInteger('broker_id')->unsigned()->nullable();
            $table->foreign('broker_id')->references('id')->on('brokers');
            $table->bigInteger('developer_id')->unsigned()->nullable();
            $table->foreign('developer_id')->references('id')->on('developers');
            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->enum('status', ['Pending', 'Dismissed'])->default('Pending');
            $table->bigInteger('post_report_reason_id')->unsigned()->nullable();
            $table->foreign('post_report_reason_id')->references('id')->on('post_report_reasons');
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('admins')->onDelete('SET NULL');
            $table->softDeletes();
            $table->text('other_reason')->nullable();
            $table->text('comments');
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
        Schema::dropIfExists('post_reports');
    }
}
