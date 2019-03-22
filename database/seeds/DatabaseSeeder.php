<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CitiesTableSeeder::class,
            CategoriesTableSeeder::class,
            StatusesTableSeeder::class,
            AdminSeeder::class,
            CompanyTableSeeder::class,
            MembersSeeder::class,
            ProductsTableSeeder::class,
            DealsTableSeeder::class,
            //BuySeeder::class,
           // SaleSeeder::class,
        ]);
    }
}
