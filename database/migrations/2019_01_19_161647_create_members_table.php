<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->unique()->nullable()->index('slug');
            $table->string('name')->unique();

            $table->integer('user_id')->unsigned()->index('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('info_id')->unsigned()->index('info_id')->unique();
            $table->foreign('info_id')->references('id')->on('infos');

            $table->integer('premium_id')->unsigned()->index('premium_id')->unique();
            $table->foreign('premium_id')->references('id')->on('premiums');

            $table->integer('company_id')->unsigned()->index('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->date('deleted_at')->nullable();
            $table->integer('deleted_by')->unsigned()
                ->index('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')
                ->on('members');

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
        Schema::dropIfExists('members');
    }
}
