<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->decimal('weight')->nullable();
            $table->decimal('height')->nullable();
            $table->unsignedTinyInteger('diabetes')->default(0);
            $table->unsignedTinyInteger('hypertension')->default(0);
            $table->unsignedTinyInteger('dyslipidemia')->default(0);
            $table->unsignedTinyInteger('cancer')->default(0);
            $table->unsignedTinyInteger('cardiovascular')->default(0);
            $table->unsignedTinyInteger('neurological')->default(0);
            $table->unsignedTinyInteger('bruises')->default(0);
            $table->unsignedTinyInteger('fractures')->default(0);
            $table->unsignedTinyInteger('muscle_injuries')->default(0);
            $table->unsignedTinyInteger('tobacco')->default(0);
            $table->unsignedTinyInteger('alcohol')->default(0);
            $table->string('other')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}
