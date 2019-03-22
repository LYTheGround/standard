<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_boxes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('brand')->unique()->nullable();
            $table->string('name');
            $table->string('licence')->nullable();
            $table->string('ice')->nullable();
            $table->integer('turnover')->unsigned()->nullable();
            $table->integer('taxes')->unsigned()->nullable();
            $table->string('fax')->nullable();
            $table->string('speaker');
            $table->string('address');
            $table->integer('build');
            $table->integer('floor')->unsigned()->nullable();
            $table->integer('apt_nbr')->unsigned()->nullable();
            $table->integer('zip')->unsigned()->nullable();

            $table->integer('city_id')->unsigned()->index('city_id');
            $table->foreign('city_id')->references('id')->on('cities');

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
        Schema::dropIfExists('info_boxes');
    }
}
