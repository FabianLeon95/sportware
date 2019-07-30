<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kicks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('match_id');
            $table->uuid('play_id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('kicker_id');
            $table->tinyInteger('yards');
            $table->string('type');

            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('kicker_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kicks');
    }
}
