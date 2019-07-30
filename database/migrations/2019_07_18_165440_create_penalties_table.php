<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penalties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('match_id');
            $table->uuid('play_id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('foul_id');

            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('foul_id')->references('id')->on('fouls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penalties');
    }
}
