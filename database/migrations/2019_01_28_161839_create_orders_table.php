<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedDecimal('pu');
            $table->unsignedDecimal('ht');
            $table->unsignedDecimal('tva');
            $table->unsignedDecimal('tva_payed');
            $table->unsignedDecimal('ttc');
            $table->unsignedDecimal('is')->default(0);
            $table->unsignedDecimal('profit')->default(0);


            $table->integer('quote_id')->unsigned()->index('quote_id');
            $table->foreign('quote_id')->references('id')->on('quotes');

            $table->integer('purchase_id')->unsigned()
                ->index('purchase_id')->nullable();
            $table->foreign('purchase_id')->references('id')->on('purchases');

            $table->integer('sold_id')->unsigned()
                ->index('sold_id')->nullable();
            $table->foreign('sold_id')->references('id')->on('solds');

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
        Schema::dropIfExists('orders');
    }
}
