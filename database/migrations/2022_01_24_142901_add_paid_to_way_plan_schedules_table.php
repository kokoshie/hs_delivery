<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToWayPlanSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('way_plan_schedules', function (Blueprint $table) {
            //
            $table->string('token');
            $table->integer('myawady_status');
            $table->integer('customer_status');
            $table->date('customer_date');
            $table->date('myawady_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('way_plan_schedules', function (Blueprint $table) {
            //
        });
    }
}
