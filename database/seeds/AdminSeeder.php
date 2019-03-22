<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'login' => "admin",
            'email' => "admin@ly.ly",
            'password' => Hash::make("066145392mM"),
        ])->admin()->create([
            'type' => 'A',
            'tel' => "0657834565",
            'city_id' => 2
        ]);
        auth()->setUser(\App\User::find(1));
    }
}
