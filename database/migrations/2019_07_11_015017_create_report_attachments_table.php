<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_name')->unique();
            $table->unsignedBigInteger('medical_report_id');
            $table->timestamps();

            $table->foreign('medical_report_id')->references('id')->on('medical_reports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_attachments');
    }
}
