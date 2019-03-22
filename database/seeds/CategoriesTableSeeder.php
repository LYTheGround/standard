<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['company', 'pdg', 'manager', 'accounting', 'commercial', 'delivery', 'storekeeper'];

        foreach ($categories as $category)

            Category::create(['category' => $category]);
    }
}
