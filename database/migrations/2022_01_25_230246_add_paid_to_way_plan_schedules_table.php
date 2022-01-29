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
            $table->string('receive_remark');
            $table->string('dropoff_remark');
            $table->string('myawady_remark');
            $table->string('customer_remark');
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
