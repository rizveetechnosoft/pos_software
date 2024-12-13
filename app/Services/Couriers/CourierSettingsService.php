<?php

namespace App\Services\Couriers;

use App\Business;
use Illuminate\Support\Facades\Session;

class CourierSettingsService
{
    public function getCourierSettings($courier)
    {
        $businessId = Session::get('user.business_id');
        $business   = Business::findOrFail($businessId);

        if (!$business || !$business->courier_settings) {
            throw new \Exception('Courier settings not found.');
        }

        $courierSettings = $business->courier_settings[$courier];

        foreach ($courierSettings as $key => $value) {
            if (empty($value)) {
                throw new \Exception("Invalid API configuration!" . "\n" . "Courier setting '$key' is empty for '$courier'.");
            }
        }

        return $courierSettings;
    }
}
