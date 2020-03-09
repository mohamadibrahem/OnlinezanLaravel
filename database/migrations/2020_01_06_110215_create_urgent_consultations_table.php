<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrgentConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urgent_consultations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lawyer_id');
            $table->integer('client_id');
            $table->string('status');
            $table->string('client_phone');
            $table->text('description');
            $table->text('conclusion');
            $table->text('npa');
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
        Schema::dropIfExists('urgent_consultations');
    }
}
