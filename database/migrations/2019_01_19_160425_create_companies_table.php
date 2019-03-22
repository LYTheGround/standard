<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');


            $table->string('slug')->unique();

            $table->integer('premium_id')->unsigned()->unique()->index('premium_id');
            $table->foreign('premium_id')->references('id')->on('premiums');

            $table->integer('info_box_id')->unsigned()->unique()->index('info_box_id');
            $table->foreign('info_box_id')->references('id')->on('info_boxes');

            $table->integer('admin_id')->unsigned()->index('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins');

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
        Schema::dropIfExists('companies');
    }
}
