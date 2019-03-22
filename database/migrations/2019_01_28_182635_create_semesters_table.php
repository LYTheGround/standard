<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('profit',65)->default(0);

            $table->decimal('tva',65)->default(0);
            $table->decimal('unloaded_tva',65)->default(0);

            $table->decimal('is',65)->default(0);
            $table->decimal('unloaded_is',65)->default(0);

            $table->date('month');

            $table->integer('year_id')->unsigned()->index('year_id');
            $table->foreign('year_id')->references('id')->on('years');

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
        Schema::dropIfExists('semesters');
    }
}
