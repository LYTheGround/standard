<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedDecimal('ht')->default(0);
            $table->unsignedDecimal('tva')->default(0);
            $table->unsignedDecimal('tva_payed')->default(0);
            $table->unsignedDecimal('ttc')->default(0);
            $table->unsignedDecimal('is')->default(0);
            $table->unsignedDecimal('profit')->default(0);

            $table->boolean('selected')->default(0);

            $table->integer('trade_id')->unsigned()->index('trade_id');
            $table->foreign('trade_id')->references('id')->on('trades');

            $table->integer('deal_id')->unsigned()->index('deal_id');
            $table->foreign('deal_id')->references('id')->on('deals');

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
        Schema::dropIfExists('quotes');
    }
}
