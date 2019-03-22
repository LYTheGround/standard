<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->nullable()->index('slug')->unique();
            $table->string('ref')->index('ref');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('size')->nullable();

            $table->unsignedInteger('tva')->unsigned()->default(0);
            $table->unsignedInteger('qt')->unsigned()->default(0);
            $table->unsignedInteger('min_qt')->default(0);
            $table->unsignedDecimal('amount',65)->default(0);

            $table->integer('member_id')->index('member_id');
            $table->foreign('member_id')->references('id')->on('members');

            $table->integer('company_id')->index('company_id');
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
        Schema::dropIfExists('products');
    }
}
