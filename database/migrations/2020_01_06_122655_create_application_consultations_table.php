<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_consultations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_email');
            $table->string('user_type');
            $table->string('service');
            $table->text('comment');
            $table->string('file');
            $table->integer('lawyer_id');
            $table->integer('status_id');
            $table->text('conclusion');
            $table->string('npa');
            $table->dateTime('received_datetime');
            $table->dateTime('closing_datetime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_consultations');
    }
}
