<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourneys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('course_name');
            $table->integer('entry_fee');
            $table->date('start_date');
            $table->integer('duration');
            $table->integer('rounds');
            $table->integer('society_id')->unsigned();
            $table->timestamps();

            $table->foreign('society_id')->references('id')->on('societies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tourneys');
    }
}
