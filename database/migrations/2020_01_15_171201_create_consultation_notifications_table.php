<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultationNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lawyer_id');
            $table->integer('consultation_id');
            $table->string('type');
            $table->integer('status');
            $table->integer('message_count');
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
        Schema::dropIfExists('consultation_notifications');
    }
}
