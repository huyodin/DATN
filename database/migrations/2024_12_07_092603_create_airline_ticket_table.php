<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlineTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airline_ticket', function (Blueprint $table) {
            $table->id();
            $table->integer('area_id_start');
            $table->integer('area_id_end');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('quantity');
            $table->string('logo');
            $table->bigInteger('price');
            $table->string('name');
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
        Schema::dropIfExists('airline_ticket');
    }
}
