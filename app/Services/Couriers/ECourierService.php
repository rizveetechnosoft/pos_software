<?php

namespace App\Services\Couriers;

use App\Utils\TransactionUtil;
use Illuminate\Support\Facades\Http;
use App\Services\Couriers\Validators\eCourierValidator;

class eCourierService implements CourierServiceInterface
{
    protected $baseUrl;
    protected $apiKey;
    protected $apiSecret;
    protected $apiUserID;
    protected $transactionUtil;

    public function __construct(array $config)
    {
        $this->baseUrl = $config['base_url'];
        $this->apiKey = $config['api_key'];
        $this->apiSecret = $config['api_secret'];
        $this->apiUserID = $config['api_user_id'];
        $this->transactionUtil = new TransactionUtil();
    }

    public function formatData($id, $request)
    {
        $sell = $this->transactionUtil->getSingleTransactionWithPayment($id);

        $data = [
            'product_price'     => $sell->due_amount,
            'package_code'      => $sell->invoice_no,
            'recipient_city'    => $sell->contact->city,
            'recipient_name'    => $sell->contact->name,
            'recipient_mobile'  => $sell->contact->mobile,
            'recipient_address' => $sell->shipping_address,
            'recipient_zip'     => $sell->contact->zip_code,
            'recipient_area'    => $request->e_courier_area,
            'recipient_thana'   => $request->e_courier_thana,
            'payment_method'    => $request->e_courier_payment_method,
            // 'recipient_area'    => $request->e_courier_area ? $request->e_courier_area : 'N/A',
            // 'recipient_thana'   => $request->e_courier_thana ? $request->e_courier_thana : 'N/A',
            // 'payment_method'    => $request->e_courier_payment_method ? $request->e_courier_payment_method : 'COD',
        ];

        return $data;
    }
    
    public function validateData(array $data)
    {
        return eCourierValidator::validate($data);
    }

    public function createOrder(array $data)
    {
        $response = Http::withHeaders([
            'API-KEY'       => $this->apiKey,
            'API-SECRET'    => $this->apiSecret,
            'USER-ID'       => $this->apiUserID,
            'Content-Type'  => 'application/json',
        ])->post("{$this->baseUrl}/create_order", $data);

        if ($response->successful() && $response['response_code'] == 200) {
            // return $response->json();

            // Get the response data
            $responseData = $response->json();

            // Add the tracking code to the response data
            if (isset($responseData['ID'])) {
                $responseData['tracking_code'] = $responseData['ID'];
                $responseData['tracking_url'] = 'https://ecourier.com.bd/track/?t=' . $responseData['ID'];
            }

            return $responseData;
        } else {
            $statusCode = $response->status();
            $responseBody = $response->body();

            throw new \Exception("Error creating order (status: $statusCode):" . "\n" . 'Check your API configurations' . "\n" . $responseBody);
            // throw new \Exception("Error creating order (Status Code: $statusCode): $responseBody");
        }
    }
}
