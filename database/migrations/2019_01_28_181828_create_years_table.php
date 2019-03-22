<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('years', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('profit',65)->default(0);

            $table->decimal('tva',65)->default(0);
            $table->decimal('unloaded_tva',65)->default(0);

            $table->decimal('is',65)->default(0);
            $table->decimal('unloaded_is',65)->default(0);

            $table->year('year');

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
        Schema::dropIfExists('years');
    }
}
