<?php

namespace App\Http\Controllers\Company;

use App\company;
use App\Admin;
use App\Http\Requests\Company\CompanyRequest;
use App\Http\Requests\Company\SoldRequest;
use App\Http\Requests\Company\StatusRequest;
use App\Info_box;
use App\Premium;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    public function index(Company $company)
    {
        $this->authorize('owner',Admin::class);

        return view('company.index',['companies' => $company->liste()]);
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(CompanyRequest $request, Company $company, Premium $premium, Info_box $info_box, User $user)
    {
        $brand = null;

        if($request->brand_){
            $brand = $request->brand_->store('public/companies');
        }

        $request->request->add(['brand' => $brand, 'city_id' => $request->city]);

        $company = $company->onStore($request,$premium,$info_box,$user);

        return redirect()->route('company.show',compact('company'));
    }

    public function show(company $company)
    {

        $this->authorize('creator',$company);

        $token = $company->tokens[0];

        return view('company.show',compact('company','token'));
    }

    public function edit(company $company)
    {
        $this->authorize('creator',$company);

        return view('company.edit',compact('company'));
    }

    public function update(CompanyRequest $request, company $company)
    {
        $brand = $company->info_box->brand;

        if($request->brand_){
            if($brand){
                Storage::disk('public')->delete($brand);
            }
            $brand = $request->brand_->store('companies');
        }
        $request->request->add(['brand' => $brand, 'city_id' => $request->city]);

        $company->onUpdate($request);

        return redirect()->route('company.show',compact('company'));
    }

    public function destroy(company $company)
    {
        $company->onDelete();

        return redirect()->route('home');
    }

    public function sold(Company $company)
    {
        $this->authorize('owner',Admin::class);

        return view('company.sold',compact('company'));
    }

    public function updateSold(SoldRequest $request, Company $company)
    {
        $company->onUpdateSold($request);

        return redirect()->route('company.show',compact('company'));
    }

    public function status(Company $company)
    {
        $this->authorize('owner',Admin::class);

        return view('company.status',compact('company'));
    }

    public function updateStatus(StatusRequest $request, Company $company)
    {
        $company->onUpdateStatus($request,$company->premium);
        return back();
    }
}
