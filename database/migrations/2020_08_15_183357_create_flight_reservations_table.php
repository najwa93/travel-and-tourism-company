<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('seats_count')->nullable();
            //$table->string('flight_class');
            $table->float('reservation_price')->nullable();
            $table->string('date_time')->nullable();

            $table->integer('flight_id')->unsigned()->nullable();
            $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');

            $table->integer('flight_degree_id')->unsigned()->nullable();
            $table->foreign('flight_degree_id')->references('id')->on('flight_degrees')->onDelete('cascade');;

            $table->integer('offer_id')->unsigned()->nullable();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');;

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
        Schema::dropIfExists('flight_reservations');
    }
}
