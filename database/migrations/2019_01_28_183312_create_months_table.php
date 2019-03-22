<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('months', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('profit',65)->default(0);

            $table->decimal('tva',65)->default(0);
            $table->decimal('unloaded_tva',65)->default(0);

            $table->decimal('is',65)->default(0);
            $table->decimal('unloaded_is',65)->default(0);

            $table->date('month');

            $table->integer('semester_id')->unsigned()->index('semester_id');
            $table->foreign('semester_id')->references('id')->on('semesters');

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
        Schema::dropIfExists('months');
    }
}
