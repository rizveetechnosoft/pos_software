<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Couriers\eCourierService;
use App\Services\Couriers\PathaoCourierService;
use App\Services\Couriers\CourierSettingsService;
use App\Services\Couriers\SteadfastCourierService;

class CourierServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CourierSettingsService::class);

        $this->app->bind('couriers.steadfast', function ($app) {
            $settings = $app->make(CourierSettingsService::class)->getCourierSettings('steadfast');
            return new SteadfastCourierService($settings);
        });

        $this->app->bind('couriers.e_courier', function ($app) {
            $settings = $app->make(CourierSettingsService::class)->getCourierSettings('e_courier');
            return new eCourierService($settings);
        });
        
        $this->app->bind('couriers.pathao', function ($app) {
            $settings = $app->make(CourierSettingsService::class)->getCourierSettings('pathao');
            return new PathaoCourierService($settings);
        });
    }

    public function boot()
    {
        //
    }
}
