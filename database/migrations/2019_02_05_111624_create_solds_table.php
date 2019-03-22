<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solds', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('qt');

            $table->unsignedInteger('purchase_id')->index('purchase_id');
            $table->foreign('purchase_id')->references('id')->on('purchases');

            $table->unsignedInteger('trade_id')->index('trade_id');
            $table->foreign('trade_id')->references('id')->on('trades');

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
        Schema::dropIfExists('solds');
    }
}
