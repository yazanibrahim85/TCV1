<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('dob');
			$table->integer('identification_no');
			$table->string('address')->nullable();
            $table->string('gender')->nullable();
			//$table->boolean('gender')->default(1);
			$table->string('phone_no')->nullable();
			$table->string('major')->nullable();
			$table->string('email')->nullable();
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
        Schema::dropIfExists('trainees');
    }
}
