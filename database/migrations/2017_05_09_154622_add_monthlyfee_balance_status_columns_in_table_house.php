<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMonthlyfeeBalanceStatusColumnsInTableHouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->float('monthlyfee',8,2)->default(2000.0);
            $table->float('balance', 8,2)->default(0.0);
            $table->string('status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('houses', function (Blueprint $table) {
            //
            $table->dropColumn(['monthlyfee', 'balance', 'status']);
        });
    }
}
