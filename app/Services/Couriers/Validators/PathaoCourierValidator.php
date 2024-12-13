<?php

namespace App\Services\Couriers\Validators;

use Illuminate\Support\Facades\Validator;

class PathaoCourierValidator
{
    public static function validate(array $data)
    {
        // Define rules
        $rules = [
            'store_id'                  => 'required|string',
            'recipient_name'            => 'required|string',
            'recipient_phone'           => 'required|string',
            'recipient_address'         => 'required|string',
            'recipient_city'            => 'required|integer',
            'recipient_zone'            => 'required|integer',
            'amount_to_collect'         => 'required|numeric',
            'delivery_type'             => 'required|integer',
            'item_quantity'             => 'required|integer',
            'item_weight'               => 'required',
            'item_type'                 => 'required|integer',
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
    }
}
