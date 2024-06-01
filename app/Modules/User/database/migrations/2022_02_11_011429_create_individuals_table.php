<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->date('date_of_birth');
            $table->string('image')->nullable();
            $table->float('current_rate');
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('admins');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('admins');
            $table->string('api_token',80)->unique()->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->unique(['provider', 'provider_id']);
            $table->string('device_id')->nullable();
            $table->enum('deviceType',['Web','Android','IOS']);
            $table->text('firebaseToken')->nullable();
            $table->enum('status',['notVerified','verified','blocked'])->default('notVerified');
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
        Schema::dropIfExists('individuals');
    }
}
