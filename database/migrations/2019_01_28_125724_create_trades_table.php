<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('buy')->default(0);
            $table->integer('ref');

            $table->integer('purchase')->unsigned()
                ->index('purchase')->nullable();
            $table->foreign('purchase')->references('id')->on('members');
            $table->dateTime('purchased_at')->nullable();

            $table->integer('sold')->unsigned()
                ->index('sold')->nullable();
            $table->foreign('sold')->references('id')->on('members');
            $table->dateTime('sold_at')->nullable();

            $table->integer('quoted')->unsigned()
                ->index('quoted')->nullable();
            $table->foreign('quoted')->references('id')->on('members');
            $table->dateTime('quote_at')->nullable();

            $table->integer('delivery')->unsigned()
                ->index('delivery')->nullable();
            $table->foreign('delivery')->references('id')->on('members');
            $table->dateTime('delivered_at')->nullable();

            $table->string('form')->nullable();
            $table->integer('formed')->unsigned()
                ->index('formed')->nullable();
            $table->foreign('formed')->references('id')->on('members');
            $table->dateTime('formed_at')->nullable();

            $table->integer('store')->unsigned()
                ->index('store')->nullable();
            $table->foreign('store')->references('id')->on('members');
            $table->dateTime('stored_at')->nullable();

            $table->string('invoice')->nullable();
            $table->integer('invoiced')->unsigned()
                ->index('invoiced')->nullable();
            $table->foreign('invoiced')->references('id')->on('members');
            $table->dateTime('invoiced_at')->nullable();

            $table->integer('company_id')->unsigned()
                ->index('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

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
        Schema::dropIfExists('trades');
    }
}
