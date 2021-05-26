<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('address_id')->index();
            $table->unsignedBigInteger('company_id')->index();
            $table->unsignedBigInteger('service_id')->index();
            $table->unsignedBigInteger('service_type_id')->index();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('car_type_id')->nullable()->index();
            $table->unsignedBigInteger('quota_id')->index()->nullable();
            $table->integer('seats_no')->nullable()->unsigned();
            $table->longText('front_image');
            $table->longText('back_image');
            $table->float('est_val')->unsigned();
            $table->unsignedInteger('people_no')->nullable();
            $table->string('receiver_number');
            $table->string('price');
            $table->unsignedBigInteger('limit_id')->index()->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('service_type_id')->references('id')->on('service_types');
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('car_type_id')->references('id')->on('car_types');
            $table->foreign('limit_id')->references('id')->on('liability_limits');
            $table->foreign('quota_id')->references('id')->on('quotas');
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
        Schema::dropIfExists('insurances');
    }
}
