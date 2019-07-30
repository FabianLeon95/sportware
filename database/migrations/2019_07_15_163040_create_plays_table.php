<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plays', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('match_id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('left_team_id');
            $table->unsignedInteger('right_team_id');
            $table->enum('down', [1,2,3,4]);
            $table->tinyInteger('to_go');
            $table->tinyInteger('ball_on');
            $table->enum('quarter',[1,2,3,4]);
            $table->tinyInteger('home_points');
            $table->tinyInteger('visit_points');
            $table->timestamps();

            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('left_team_id')->references('id')->on('teams');
            $table->foreign('right_team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plays');
    }
}
