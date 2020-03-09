<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_consultations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conversation_id');
            $table->integer('payment_id');
            $table->integer('schedule_id');
            $table->integer('lawyer_id');
            $table->integer('client_id');
            $table->string('status');
            $table->integer('time');
            $table->integer('price');
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
        Schema::dropIfExists('online_consultations');
    }
}
