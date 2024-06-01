<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->bigInteger('broker_id')->unsigned()->nullable();
            $table->foreign('broker_id')->references('id')->on('brokers');
            $table->bigInteger('developer_id')->unsigned()->nullable();
            $table->foreign('developer_id')->references('id')->on('developers');
            $table->bigInteger('listing_reason_id')->unsigned()->nullable();
            $table->foreign('listing_reason_id')->references('id')->on('listing_reasons')->onDelete('SET NULL');
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('SET NULL');
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('SET NULL');
            $table->bigInteger('listing_type_id')->unsigned()->nullable();
            $table->foreign('listing_type_id')->references('id')->on('listing_types')->onDelete('SET NULL');
            $table->boolean('in_a_compound')->default(0);
            $table->float('start_price',8,2)->default(0);
            $table->float('end_price',8,2)->default(0);
            $table->bigInteger('listing_sale_id')->unsigned()->nullable();
            $table->foreign('listing_sale_id')->references('id')->on('listing_sales')->onDelete('SET NULL');
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
            $table->bigInteger('listing_completion_id')->unsigned()->nullable();
            $table->foreign('listing_completion_id')->references('id')->on('listing_completions')->onDelete('SET NULL');
            $table->string('image');
            $table->bigInteger('listing_status_id')->unsigned()->nullable();
            $table->foreign('listing_status_id')->references('id')->on('listing_statuses')->onDelete('SET NULL');
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
        Schema::dropIfExists('listings');
    }
}
