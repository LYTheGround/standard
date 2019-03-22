<?php

use App\Deal;
use App\Http\Requests\Deal\DealRequest;
use App\Info_box;
use Illuminate\Database\Seeder;

class DealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ( $i = 1; $i < 6; $i++){

           $request = DealRequest::create('deal','post',[
                'name'          => "Deal-$i",
                'ice'           => '12345600001',
                'fax'           => "0522548798",
                'speaker'       => 'Deal $i',
                'address'       => 'BD mohamed 6',
                'build'         => 12,
                'floor'         => 1,
                'apt_nbr'       => 12,
                'zip'           => 20000,
                'city'          => 2,
                'email'         => 'deal@ly.ly',
                'tel'           => '0657834565',
                'description'   => null
            ]);

           $deal = new Deal();

           $deal->onStore($request,new Info_box());

        }

    }
}
