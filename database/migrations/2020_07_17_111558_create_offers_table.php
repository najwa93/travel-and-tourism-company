<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customers_count')->nullable();
            $table->integer('seats_number')->nullable();
            $table->float('price')->nullable();
            $table->string('offer_duration')->nullable();
           // $table->string('phone_number')->nullable();
            $table->string('details')->nullable();
            $table->boolean('status')->nullable();

            $table->integer('flight_degree_id')->unsigned()->nullable();
            $table->foreign('flight_degree_id')->references('id')->on('flight_degrees')->onDelete('cascade');

            $table->integer('flight_id')->unsigned()->nullable();
            $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');

            $table->integer('returned_flight_id')->unsigned()->nullable();
            $table->foreign('returned_flight_id')->references('id')->on('flights')->onDelete('cascade');

            $table->integer('hotel_id')->unsigned()->nullable();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
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
        Schema::dropIfExists('offers');
    }
}
