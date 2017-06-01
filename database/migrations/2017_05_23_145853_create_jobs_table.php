<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned();
            $table->integer('employee1_id')->unsigned();
            $table->integer('employee2_id')->unsigned();
            $table->integer('employee3_id')->unsigned();
            $table->integer('employee4_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->string('status')->default('ongoing');
            $table->timestamps();

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('employee1_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('employee2_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('employee3_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('employee4_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
