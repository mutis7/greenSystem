<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('house');
            $table->integer('location_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->float('monthlyfee',8,2)->default(2000.0);
            $table->float('balance', 8,2)->default(0.0);
            $table->string('activated_at')->default("3000-01-01 00:00:00");
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
