<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->nullable()->unique()->index('slug');
            $table->longText('description')->nullable();

            $table->integer('info_box_id')->unsigned()->index('info_box_id');
            $table->foreign('info_box_id')->references('id')->on('info_boxes');

            $table->integer('member_id')->unsigned()->index('member_id');
            $table->foreign('member_id')->references('id')->on('members');

            $table->integer('company_id')->unsigned()->index('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->date('deleted_at')->nullable();

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
        Schema::dropIfExists('deals');
    }
}
