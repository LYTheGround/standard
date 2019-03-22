<?php

use App\Http\Requests\Company\CompanyRequest;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $company = new \App\Company();

        $request = CompanyRequest::create('/company','post',[
            'brand'         => "companies/logo.png",
            'name'          => "The Ground LY",
            'licence'       => 123789456,
            'ice'           => 1025800001,
            'turnover'      => 10000,
            'taxes'         => 10,
            'fax'           => "0522039833",
            'tel'           => "0691039833",
            'email'         => "yasser@gmail.com",
            'speaker'       => "YASSER",
            'address'       => "BD mohamed 6 jamila I",
            'build'         => 10,
            'floor'         => 2,
            'apt_nbr'       => 15,
            'zip'           => 20000,
            'city_id'       => 2
        ]);

        $company->onStore($request,new \App\Premium(),new \App\Info_box(), new \App\User());
    }
}
