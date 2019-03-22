<?php

use App\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cities = ['Agadir', 'Casablanca', 'Rabat'];

        foreach ($cities as $city)

            City::create(['city'  => $city]);

    }
}
