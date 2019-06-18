<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('medic_id');
            $table->unsignedInteger('patient_id');
            $table->string('visit_reason');
            $table->text('diagnostic');
            $table->text('treatment');
            $table->text('observations')->nullable();
            $table->timestamps();

            $table->foreign('medic_id')->references('id')->on('users');
            $table->foreign('patient_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_reports');
    }
}
