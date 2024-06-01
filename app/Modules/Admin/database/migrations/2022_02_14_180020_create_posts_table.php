<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('individual_id')->unsigned();
            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('CASCADE');
            $table->bigInteger('post_reason_id')->unsigned()->nullable();
            $table->foreign('post_reason_id')->references('id')->on('post_reasons')->onDelete('SET NULL');
            $table->bigInteger('post_reason_option_id')->unsigned()->nullable();
            $table->foreign('post_reason_option_id')->references('id')->on('post_reason_options')->onDelete('SET NULL');
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('SET NULL');
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('SET NULL');
            $table->bigInteger('post_type_id')->unsigned()->nullable();
            $table->foreign('post_type_id')->references('id')->on('post_types')->onDelete('SET NULL');
            $table->boolean('in_a_compound')->default(0);
            $table->float('start_price',8,2)->default(0);
            $table->float('end_price',8,2)->default(0);
            $table->bigInteger('post_sale_id')->unsigned()->nullable();
            $table->foreign('post_sale_id')->references('id')->on('post_sales')->onDelete('SET NULL');
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
            $table->string('image');
            $table->longText('description')->nullable();
            $table->bigInteger('post_status_id')->unsigned()->nullable();
            $table->foreign('post_status_id')->references('id')->on('post_statuses')->onDelete('SET NULL');
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('admins')->onDelete('SET NULL');
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
