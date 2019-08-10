<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_assistances', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->unsignedInteger('player_id');

            $table->primary(['event_id', 'player_id']);
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('player_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_assistances');
    }
}
