<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTacklesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tackles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('match_id');
            $table->uuid('play_id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('tackler_id');
            $table->unsignedInteger('assist_id')->nullable();

            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('tackler_id')->references('id')->on('players');
            $table->foreign('assist_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tackles');
    }
}
