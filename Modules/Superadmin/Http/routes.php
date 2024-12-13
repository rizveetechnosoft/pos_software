<?php

Route::get('/pricing', 'Modules\Superadmin\Http\Controllers\PricingController@index')->name('pricing');

Route::group(['middleware' => ['web', 'auth', 'language', 'AdminSidebarMenu', 'superadmin'], 'prefix' => 'superadmin', 'namespace' => 'Modules\Superadmin\Http\Controllers'], function () {
    Route::get('/install', 'InstallController@index');
    Route::get('/install/update', 'InstallController@update');
    Route::get('/install/uninstall', 'InstallController@uninstall');

    Route::get('/', 'SuperadminController@index');
    Route::get('/stats', 'SuperadminController@stats');
    
    Route::get('/{business_id}/toggle-active/{is_active}', 'BusinessController@toggleActive');

    Route::get('/users/{business_id}', 'BusinessController@usersList');
    Route::post('/update-password', 'BusinessController@updatePassword');


    Route::resource('/business', 'BusinessController');
    Route::get('/business/{id}/destroy', 'BusinessController@destroy');
    Route::get('business/{id}/client-login', 'BusinessController@client_login');

    Route::resource('/packages', 'PackagesController');
    Route::get('/packages/{id}/destroy', 'PackagesController@destroy');

    Route::get('/settings', 'SuperadminSettingsController@edit');
    Route::put('/settings', 'SuperadminSettingsController@update');
    Route::get('/edit-subscription/{id}', 'SuperadminSubscriptionsController@editSubscription');
    Route::post('/update-subscription', 'SuperadminSubscriptionsController@updateSubscription');
    Route::resource('/superadmin-subscription', 'SuperadminSubscriptionsController');

    Route::get('/communicator', 'CommunicatorController@index');
    Route::post('/communicator/send', 'CommunicatorController@send');
    Route::get('/communicator/get-history', 'CommunicatorController@getHistory');

    Route::get('/affiliate', 'AffiliateController@index');
    Route::get('/affiliate/promotter-list', 'AffiliateController@getPromotter');
    Route::get('/affiliate/promotter-view/{id}', 'AffiliateController@viewReffer');

    Route::get('/affiliate/reffer-list/{id}', 'AffiliateController@getReffer');

    //Super admin Notice
    Route::get('/notice', 'SuperadminNoticeController@edit');
    Route::post('/notice/update', 'SuperadminNoticeController@update');


    Route::get('/superadmin-message', 'SuperadminNoticeController@messageInfo');

    Route::get('/superadmin/sms-info', 'SuperadminNoticeController@getSMSInformation');



    Route::resource('/frontend-pages', 'PageController');
});

Route::group(['middleware' => ['web', 'SetSessionData', 'auth', 'language', 'timezone', 'AdminSidebarMenu'],
    'namespace' => 'Modules\Superadmin\Http\Controllers'], function () {
        //Routes related to paypal checkout
        Route::get('/subscription/{package_id}/paypal-express-checkout', 'SubscriptionController@paypalExpressCheckout');

        Route::get('/subscription/post-flutterwave-payment', 'SubscriptionController@postFlutterwavePaymentCallback');
        
        Route::post('/subscription/pay-stack', 'SubscriptionController@getRedirectToPaystack');
        Route::get('/subscription/post-payment-pay-stack-callback', 'SubscriptionController@postPaymentPaystackCallback');
        
        //Routes related to pesapal checkout
        Route::get('/subscription/{package_id}/pesapal-callback', ['as' => 'pesapalCallback', 'uses'=>'SubscriptionController@pesapalCallback']);

        Route::get('/subscription/{package_id}/pay', 'SubscriptionController@pay');
        Route::any('/subscription/{package_id}/confirm', 'SubscriptionController@confirm')->name('subscription-confirm');
        Route::get('/all-subscriptions', 'SubscriptionController@allSubscriptions');

        Route::get('/subscription/{package_id}/register-pay', 'SubscriptionController@registerPay')->name('register-pay');
        Route::get('/subscription/show-invoice/{id}', 'SubscriptionController@show_invoice')->name('show_invoice');
        Route::resource('/subscription', 'SubscriptionController');
        
        Route::post('/subscription/pay-bkash', 'SubscriptionController@paybkashpayment')->name('subscription/pay-bkash');
    });

Route::get('/page/{slug}', 'Modules\Superadmin\Http\Controllers\PageController@showPage')->name('frontend-pages');
