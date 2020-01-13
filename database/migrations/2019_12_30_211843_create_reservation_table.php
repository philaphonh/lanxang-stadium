<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_reservation', function (Blueprint $table) {
            $table->increments('reservation_id');
            $table->string('customer_name');
            $table->integer('stadium_id')->unsigned();
            $table->dateTime('reserve_date');
            $table->date('selected_date');
            $table->integer('selected_time_id')->unsigned();
            $table->boolean('is_checked_in');
            // $table->primary('reservation_id');
            $table->foreign('stadium_id')->references('stadium_id')->on('tbl_stadium');
            $table->foreign('selected_time_id')->references('time_id')->on('tbl_schedule');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation');
    }
}
