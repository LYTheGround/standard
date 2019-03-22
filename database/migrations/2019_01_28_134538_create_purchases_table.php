<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('qt');
            $table->unsignedInteger('qt_offer')->default(0);
            $table->unsignedInteger('offer')->default(0);

            $table->integer('trade_id')->unsigned()->index('trade_id');
            $table->foreign('trade_id')->references('id')->on('trades');

            $table->integer('product_id')->unsigned()->index('product_id');
            $table->foreign('product_id')->references('id')->on('products');

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
        Schema::dropIfExists('purchases');
    }
}
