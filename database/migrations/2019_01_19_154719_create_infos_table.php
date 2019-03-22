<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('face')->nullable()->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('sex')->nullable();
            $table->date('birth')->nullable();
            $table->string('address')->nullable();
            $table->string('cin')->nullable();

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
        Schema::dropIfExists('infos');
    }
}
