<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('course_id')->nullable();
            $table->integer('participants_no')->nullable();
            $table->integer('training_hours')->nullable();
            $table->string('course_begin_date')->nullable();
            $table->string('course_end_date')->nullable();
            $table->string('expiration_date')->nullable();
            $table->string('sponsored_by')->nullable();
            $table->string('beneficiary')->nullable();
            $table->integer('area_id')->nullable();
            $table->string('location')->nullable();
			
			$table->softDeletes();
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
        Schema::dropIfExists('courses');
    }
}
