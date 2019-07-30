<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('season_id');
            $table->unsignedInteger('home_team_id');
            $table->unsignedInteger('visit_team_id');
            $table->string('game_type');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('season_id')->references('id')->on('seasons');
            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->foreign('visit_team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
