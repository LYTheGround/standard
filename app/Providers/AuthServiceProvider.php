<?php

namespace App\Providers;

use App\Admin;
use App\Company;
use App\Deal;
use App\Member;
use App\Policies\Admin\AdminPolicy;
use App\Policies\Company\CompanyPolicy;
use App\Policies\Deal\DealPolicy;
use App\Policies\Premium\TokenPolicy;
use App\Policies\Rh\MemberPolicy;
use App\Policies\Rh\PositionPolicy;
use App\Policies\Storage\ProductPolicy;
use App\Policies\Trade\TradePolicy;
use App\Position;
use App\Product;
use App\Token;
use App\Trade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Admin::class => AdminPolicy::class,
        Company::class => CompanyPolicy::class,
        Token::class => TokenPolicy::class,
        Member::class => MemberPolicy::class,
        Position::class => PositionPolicy::class,
        Product::class => ProductPolicy::class,
        Deal::class => DealPolicy::class,
        Trade::class => TradePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
