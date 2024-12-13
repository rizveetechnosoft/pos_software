<?php

namespace App\Services\Couriers\Validators;

use Illuminate\Support\Facades\Validator;

class eCourierValidator
{
    public static function validate(array $data)
    {
        // Rename 'recipient_phone' to 'recipient_mobile' for validation
        if (isset($data['recipient_phone'])) {
            $data['recipient_mobile'] = $data['recipient_phone'];
            unset($data['recipient_phone']);
        }
        
        // Define rules
        $rules = [
            'package_code'              => 'required|string',
            'recipient_name'            => 'required|string',
            'recipient_mobile'          => 'required|string',
            'recipient_city'            => 'required|string',
            'recipient_area'            => 'required|string',
            'recipient_thana'           => 'required|string',
            'recipient_address'         => 'required|string',
            'recipient_zip'             => 'required|string',
            'payment_method'            => 'required|string',
            'product_price'             => 'required|numeric',

            'recipient_landmark'        => 'nullable|string',
            'parcel_type'               => 'nullable|string',
            'requested_delivery_time'   => 'nullable|string',
            'delivery_hour'             => 'nullable|string',
            'note'                      => 'nullable|string',
        ];

        // Validate the data
        $validator = Validator::make($data, $rules);

        // If validation fails, throw an exception
        if ($validator->fails()) {
            $errors = implode("\n", $validator->errors()->all());
            throw new \Exception('Validation failed: ' . "\n" . $errors);
        }
        
        // Return the validated data
        return $validator->validated();

        // // Get the validated data
        // $validatedData = $validator->validated();

        // // Rename 'recipient_mobile' back to 'recipient_phone' in the validated data
        // if (isset($validatedData['recipient_mobile'])) {
        //     $validatedData['recipient_phone'] = $validatedData['recipient_mobile'];
        //     unset($validatedData['recipient_mobile']);
        // }

        // // Return the validated data
        // return $validatedData;
    }
}
