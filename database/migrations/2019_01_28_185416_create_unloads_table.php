<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unloads', function (Blueprint $table) {
            $table->increments('id');

            $table->string('justify');
            $table->unsignedDecimal('prince',65);
            $table->date('date');
            $table->boolean('tva')->default(false);
            $table->longText('description')->nullable();

            $table->integer('member_id')->unsigned()->index('member_id');
            $table->foreign('member_id')->references('id')->on('member');

            $table->integer('month_id')->unsigned()->index('month_id');
            $table->foreign('month_id')->references('id')->on('months');

            $table->integer('company_id')->unsigned()->index('company_id');
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
        Schema::dropIfExists('unloads');
    }
}
