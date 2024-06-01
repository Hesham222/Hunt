<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('individual_id')->unsigned()->nullable();
            $table->foreign('individual_id')->references('id')->on('individuals');
            $table->bigInteger('broker_id')->unsigned()->nullable();
            $table->foreign('broker_id')->references('id')->on('brokers');
            $table->bigInteger('developer_id')->unsigned()->nullable();
            $table->foreign('developer_id')->references('id')->on('developers');
            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->string('developer')->nullable();
            $table->integer('rooms')->default(0);
            $table->float('size_of_property',8,2)->default(0);
            $table->float('payment',8,2)->default(0);
            $table->float('start_down_payment',8,2)->default(0);
            $table->float('end_down_payment',8,2)->default(0);
            $table->float('start_monthly_installment',8,2)->default(0);
            $table->float('end_monthly_installment',8,2)->default(0);
            $table->float('start_payment_duration',8,2)->default(0);
            $table->float('end_payment_duration',8,2)->default(0);
            $table->date('delivery_date')->nullable();
            $table->bigInteger('post_completion_id')->unsigned()->nullable();
            $table->foreign('post_completion_id')->references('id')->on('post_completions')->onDelete('SET NULL');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->bigInteger('post_status_id')->unsigned()->nullable();
            $table->foreign('post_status_id')->references('id')->on('post_statuses')->onDelete('SET NULL');
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
        Schema::dropIfExists('comments');
    }
}
