<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifiers', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('monday')->default(0);
            $table->smallInteger('tuesday')->default(0);
            $table->smallInteger('wednesday')->default(0);
            $table->smallInteger('thursday')->default(0);
            $table->smallInteger('friday')->default(0);
            $table->smallInteger('saturday')->default(0);
            $table->smallInteger('sunday')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifiers');
    }
}
