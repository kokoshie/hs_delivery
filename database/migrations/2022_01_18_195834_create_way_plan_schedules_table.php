<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWayPlanSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('way_plan_schedules', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->integer('receive_point');
            $table->string('receive_address');
            $table->date('receive_date');
            $table->integer('dropoff_point');
            $table->string('dropoff_address');
            $table->date('dropoff_date');
            $table->string('tracking_id');

            $table->string('remark');
            $table->integer('parcel_quantity');
            $table->integer('total_weight');
            $table->integer('per_kg_charges');
            $table->integer('package_id');
            $table->integer('total_charges');
            $table->integer('receive_status');
            $table->integer('dropoff_status');
            $table->integer('rider_id');
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
        Schema::dropIfExists('way_plan_schedules');
    }
}
