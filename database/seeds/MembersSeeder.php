<?php

use App\Category;
use App\Info;
use App\Member;
use App\Premium;
use App\User;
use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories= Category::where('id', '>', 1)->get();

        foreach ($categories as $category){

            $token = $category->tokens()->create([
                'range'     => 5,
                'token'     => md5(sha1(rand())),
                'company_id'=> 1
            ]);

            $data = [
                'name'          => $category->category,
                'token'         => $token->token,
                'email'         => $category->category . '@ly.ly',
                'tel'         => "069103983" . $category->id,
                'password'      => "066145392mM",
                'last_name'     => $category->category,
                'first_name'    => $category->category,
                'sex'           => "homme",
                'birth'         => \Carbon\Carbon::createFromDate(1987,07,20),
                'address'       => "Bd Mohamed 6 jamila I n°1443",
                'city'          => 2,
                'cin'           => "bh124578"
            ];

            $user = new Member();

            $user->onCreate(new User(),new Info(),new Premium(), $data);
        }

        auth()->setUser(\App\User::find(2));
    }
}
