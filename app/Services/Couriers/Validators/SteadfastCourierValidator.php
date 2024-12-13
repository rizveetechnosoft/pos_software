<?php

namespace App\Services\Couriers\Validators;

use Illuminate\Support\Facades\Validator;

class SteadfastCourierValidator
{
    public static function validate(array $data)
    {
        // Define rules
        $rules = [
            'invoice'           => 'required|string',
            'recipient_name'    => 'required|string',
            'recipient_phone'   => 'required|string',
            'recipient_address' => 'required|string',
            'cod_amount'        => 'required|numeric',
            'note'              => 'nullable|string',
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
