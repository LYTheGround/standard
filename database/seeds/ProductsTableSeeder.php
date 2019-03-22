<?php

use App\Http\Requests\Storage\ProductRequest;
use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 6; $i++){

            $request = ProductRequest::create('/product','post',[
                'name'          => "product-$i",
                'description'   => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum",
                'size'          => "15x16x12",
                'tva'           => 20,
                'min_qt'        => 10
            ]);

            $product = new Product();

            $product->onStore($request);
        }
    }
}
