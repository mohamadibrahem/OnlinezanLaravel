<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawyers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('city_id')->nullable();
            $table->string('status')->nullable();
            $table->string('category_id')->nullable();
            $table->string('specialization_id')->nullable();
            $table->integer('online_consultation_price')->nullable();
            $table->integer('urgent_consultation_price')->nullable();
            $table->integer('consultation_time')->nullable()->default('10');
            $table->text('education')->nullable();
            $table->text('biography')->nullable();
            $table->string('video')->nullable();
            $table->string('service_types')->nullable()->default('["1"]');
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
        Schema::dropIfExists('lawyers');
    }
}
