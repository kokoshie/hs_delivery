<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageKgPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_kg__prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('package_id');
            $table->integer('min_kg');
            $table->integer('max_kg');
            $table->integer('per_kg_price');
            $table->string('currency');
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
        Schema::dropIfExists('package_kg__prices');
    }
}
