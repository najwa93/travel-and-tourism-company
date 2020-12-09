<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('economy_seats_count')->nullable();
            $table->integer('first_class_seats_count')->nullable();
            $table->float('economy_ticket_price')->nullable();
            $table->float('first_class_ticket_price')->nullable();
            $table->string('flight_duration')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('updated_time')->nullable();

            $table->integer('source_city_id')->unsigned()->nullable();
            $table->foreign('source_city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->integer('destination_city_id')->unsigned()->nullable();
            $table->foreign('destination_city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->integer('flight_company_id')->unsigned()->nullable();
            $table->foreign('flight_company_id')->references('id')->on('flight_companies')->onDelete('cascade');
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
        Schema::dropIfExists('flights');
    }
}
