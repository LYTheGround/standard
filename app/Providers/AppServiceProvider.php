<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer(['layouts.admin.navbar','layouts.navbar'], function($view) {

            if(auth()->user()){
                $count_notifications = DB::table('notifications')
                    ->select(DB::raw('count(*) as count_notification'))
                    ->where('notifiable_id', '=', auth()->user()->id)
                    ->where('read_at', '=', null)
                    ->first();
                if($count_notifications && $count_notifications->count_notification != 0){
                    $view->with(['count_notifications'=> $count_notifications->count_notification]);
                }

            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
