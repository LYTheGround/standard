<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedDecimal('payment');
            $table->date('date');
            $table->dateTime('payed_at')->nullable();

            $table->integer('payed_id')->unsigned()
                ->index('payed_id')->nullable();
            $table->foreign('payed_id')->references('id')->on('members');

            $table->integer('payed_by_id')->unsigned()
                ->index('payed_by_id')->nullable();
            $table->foreign('payed_by_id')->references('id')->on('deals');

            $table->integer('creator_id')->unsigned()
                ->index('creator_id')->nullable();
            $table->foreign('creator_id')->references('id')->on('members');

            $table->integer('company_id')->unsigned()
                ->index('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->integer('quote_id')->unsigned()
                ->index('quote_id');
            $table->foreign('quote_id')->references('id')->on('quotes');

            $table->integer('trade_id')->unsigned()
                ->index('trade_id');
            $table->foreign('trade_id')->references('id')->on('trades');

            $table->integer('month_id')->unsigned()
                ->index('month_id');
            $table->foreign('month_id')->references('id')->on('months');

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
        Schema::dropIfExists('terms');
    }
}
