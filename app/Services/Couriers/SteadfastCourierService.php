<?php

namespace App\Services\Couriers;

use App\Utils\TransactionUtil;
use Illuminate\Support\Facades\Http;
use App\Services\Couriers\Validators\SteadfastCourierValidator;

class SteadfastCourierService implements CourierServiceInterface
{
    protected $baseUrl;
    protected $apiKey;
    protected $apiSecret;
    protected $transactionUtil;

    public function __construct(array $config)
    {
        $this->baseUrl = $config['base_url'];
        $this->apiKey = $config['api_key'];
        $this->apiSecret = $config['api_secret'];
        $this->transactionUtil = new TransactionUtil();
    }

    public function formatData($id, $request)
    {
        $sell = $this->transactionUtil->getSingleTransactionWithPayment($id);

        // Required data for Steadfast
        $data = [
            'invoice'           => $sell->invoice_no,
            'recipient_name'    => $sell->contact->name,
            'recipient_phone'   => $sell->contact->mobile,
            'recipient_address' => $sell->shipping_address,
            'cod_amount'        => $sell->due_amount,
            'note'              => null,
        ];

        return $data;
    }

    public function validateData(array $data)
    {
        return SteadfastCourierValidator::validate($data);
    }
    
    public function createOrder(array $data)
    {
        $response = Http::withHeaders([
            'Api-Key'       => $this->apiKey,
            'Secret-Key'    => $this->apiSecret,
            'Content-Type'  => 'application/json',
        ])->post("{$this->baseUrl}/create_order", $data);

        if ($response->successful() && $response['status'] == 200) {
            // return $response->json();

            // Get the response data
            $responseData = $response->json();

            // Add the tracking code to the response data
            if (isset($responseData['consignment']['tracking_code'])) {
                $responseData['tracking_code'] = $responseData['consignment']['tracking_code'];
                $responseData['tracking_url'] = 'https://steadfast.com.bd/t/' . $responseData['consignment']['tracking_code'];
            }

            return $responseData;
        } else {
            $responseBody = $response->body();
            
            // Parse the response body to get the errors
            $errors = json_decode($responseBody, true)['errors'] ?? [];
            $errorMessages = [];

            // Format the errors as key-pair with line breaks
            foreach ($errors as $key => $messages) {
                $errorMessages[] = $key . ': ' . implode(', ', $messages);
            }

            $formattedErrors = implode("\n", $errorMessages);

            throw new \Exception("Error creating order:\n" . $formattedErrors);
            // throw new \Exception("Error creating order (status: $statusCode):" . "\n" . 'Check your API configurations' . "\n" . $responseBody);
        }
    }
}