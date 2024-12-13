<?php

namespace App\Services\Couriers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

interface CourierServiceInterface
{
    public function formatData($id, Request $request);
    public function validateData(array $data);
    public function createOrder(array $data);
}