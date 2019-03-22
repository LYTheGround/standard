<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::post('language/', [
    'before'    => 'csrf',
    'as'        => 'language-chooser',
    'uses'      => 'LanguageController@changeLanguage'
]);

Route::middleware('auth')->group(function (){

    Route::get('/', 'HomeController@index')->name('home');

    Route::prefix('notifications')->group(function (){

        Route::get('','notificationController@index')->name('notification.index');
        Route::post('','notificationController@read')->name('notification.read');
        Route::delete('','notificationController@destroy')->name('notification.destroy');


    });

    Route::middleware('admin')->group(function (){

        Route::namespace('Admin')->group(function (){

            Route::get('admin/params','AdminController@params')->name('admin.params');
            Route::put('admin/params','AdminController@updateParams')->name('admin.params.update');

            Route::resource('admin','AdminController')->except(['edit', 'update']);

        });

        Route::namespace('Company')->group(function (){

            Route::get('company/{company}/status', 'CompanyController@status')->name('company.status');
            Route::put('company/{company}/status', 'CompanyController@updateStatus')->name('company.updateStatus');

            Route::get('company/{company}/sold', 'CompanyController@sold')->name('company.sold');
            Route::put('company/{company}/sold', 'CompanyController@updateSold')->name('company.updateSold');

            Route::resource('company', 'CompanyController');

        });

    });

    Route::middleware(['user', 'premium'])->group(function (){

        Route::resource('token','Premium\TokenController')->except(['edit', 'update', 'show']);

        Route::namespace('Rh')->group(function (){

            Route::resource('member','MemberController')->except(['edit', 'update']);

            Route::get('params', 'MemberController@params')->name('member.params');
            Route::post('params', 'MemberController@updateParams')->name('member.update');

            Route::get('psw', 'MemberController@psw')->name('member.psw');
            Route::post('psw', 'MemberController@updatePsw')->name('member.psw');

            Route::get('{member}/member/range','MemberController@range')->name('member.range');
            Route::put('{member}/member/range', 'MemberController@updateRange')->name('member.range.update');

            Route::get('{member}/member/status', 'MemberController@status')->name('member.status');
            Route::put('{member}/member/status', 'MemberController@updateStatus')->name('member.status.update');

            Route::resource('position', 'PositionController');
        });

        Route::namespace('Storage')->group(function (){

            Route::resource('product','ProductController');

            Route::delete('product/{product}/img/{product_img}','ProductController@destroyImg')
                            ->name('product.img.destroy');

        });

        Route::resource('deal', 'Deal\DealController');

        Route::namespace('Trade')->group(function (){

            Route::namespace('Buy')->group(function (){
                Route::prefix('buy/{buy}')->group(function (){

                    Route::get('purchase','PurchaseController@create')
                        ->name('purchase.create');

                    Route::post('purchase','PurchaseController@store')
                        ->name('purchase.store');

                    Route::delete('purchase/{purchase}','PurchaseController@destroy')
                        ->name('purchase.destroy');

                    Route::post('purchase/confirm','PurchaseController@confirmed')
                        ->name('purchase.confirmed');

                    Route::put('purchase/confirm','PurchaseController@notConfirmed')
                        ->name('purchase.not_confirmed');

                    Route::prefix('quote')->group(function (){

                        Route::get('not_confirm','QuoteController@notConfirmed')->name('buy.quote.not_confirmed');

                        Route::get('confirm','QuoteController@confirmed')->name('buy.quote.confirmed');

                        Route::get('create','QuoteController@create')->name('buy.quote.create');

                        Route::post('/','QuoteController@store')->name('buy.quote.store');

                        Route::delete('/{quote}','QuoteController@destroy')->name('buy.quote.delete');

                        Route::get('{quote}/selected','QuoteController@selected')->name('buy.quote.selected');

                        Route::get('{quote}','QuoteController@show')->name('buy.quote.show');

                    });


                });

                Route::get('buy-list','BuyController@liste')->name('buy.list');
                Route::resource('buy','BuyController')->except(['edit','update']);

            });

            Route::namespace('sale')->group(function (){
                Route::get('{sale}/sold/create','SoldController@create')->name('sold.create');
                Route::post('{sale}/sold','SoldController@store')->name('sold.store');
                Route::post('{sale}/sold/liste','SoldController@liste')->name('sold.list');
                Route::delete('{sale}/sold/{sold}','SoldController@destroy')->name('sold.destroy');
                Route::get('{sale}/sold/confirm','SoldController@confirm')->name('sold.confirm');
                Route::get('{sale}/sold/confirm-delete','SoldController@destroyConfirm')->name('sold.destroy.confirm');

                Route::resource('sale','SaleController')->except(['edit','update']);
                Route::get('sale/{sale}/release/{purchase}','SoldController@release')->name('sale.release');
                Route::get('sale/{sale}/fc','SaleController@fc')->name('sale.fc');
                Route::get('sale/{sale}/bl','SaleController@bl')->name('sale.bl');
                Route::get('sale-list','SaleController@liste')->name('sale.list');
            });

            Route::delete('trade/{trade}/stored','TradeController@onDeleteStore')->name('trade.store.destroy');
            Route::post('trade/{trade}/stored','TradeController@onStoreStore')->name('trade.store.store');

            Route::delete('trade/{trade}/delivered','TradeController@onDeleteDelivery')->name('trade.delivery.destroy');
            Route::post('trade/{trade}/delivered','TradeController@onStoreDelivery')->name('trade.delivery.store');

            Route::delete('trade/{trade}/formed','TradeController@onDeleteForm')->name('trade.form.destroy');
            Route::post('trade/{trade}/formed','TradeController@onStoreForm')->name('trade.form.store');

            Route::delete('trade/{trade}/invoice','TradeController@onDeleteInvoice')->name('trade.invoice.destroy');
            Route::post('trade/{trade}/invoice','TradeController@onStoreInvoice')->name('trade.invoice.store');


        });

        Route::namespace('Money')->group(function (){

            Route::prefix('{trade}')->group(function (){
                Route::post('term/create','TermController@create')->name('buy.term.create');
                Route::post('term','TermController@store')->name('buy.term.store');
                Route::delete('term/delete','TermController@destroy')->name('buy.term.destroy');
            });

            Route::get('term','TermController@index')->name('term.index');
            Route::get('term/{term}','TermController@show')->name('term.show');
            Route::post('term/{term}/payment','TermController@payment')->name('term.payment');
            Route::delete('term/{term}/payment','TermController@deletePayment')->name('term.payment.delete');
            Route::get('term-list','TermController@liste')->name('term.list');

            Route::resource('unload','UnloadController');
        });

    });

});
