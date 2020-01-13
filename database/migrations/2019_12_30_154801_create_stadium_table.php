<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_stadium', function (Blueprint $table) {
            $table->increments('stadium_id');
            $table->string('stadium_name');
            $table->string('stadium_type');
            $table->integer('stadium_capacity');
            $table->float('stadium_fee');
            // $table->primary('stadium_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_stadium');
    }
}
