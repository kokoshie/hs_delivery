<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerAddressToWayPlanSchedulesTable extends Migration
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
            $table->string('customer_address');
            $table->integer('customer_status');
            $table->integer('myawady_status');
            $table->date('myawady_date');
            $table->date('customer_date');
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
