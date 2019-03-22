<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_products', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('min_prince',65)->default(0);
            $table->decimal('turnover',65)->default(0);
            $table->decimal('tva',65)->default(0);
            $table->decimal('is',65)->default(0);
            $table->decimal('profit',65)->default(0);

            $table->integer('product_id')->unsigned()->index('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('deal_id')->unsigned()->index('deal_id');
            $table->foreign('deal_id')->references('id')->on('deals');

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
        Schema::dropIfExists('deal_products');
    }
}
