<?php

namespace App\Services\Couriers;

use Carbon\Carbon;
use App\Utils\TransactionUtil;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Services\Couriers\Validators\PathaoCourierValidator;

class PathaoCourierService implements CourierServiceInterface
{
    protected $baseUrl;
    protected $clientID;
    protected $grantType;
    protected $clientSecret;
    protected $clientEmail;
    protected $clientPassword;
    // protected $storeID;
    protected $transactionUtil;

    public function __construct(array $config)
    {
        $this->baseUrl          = $config['base_url'];
        $this->clientID         = $config['client_id'];
        $this->grantType        = 'password';
        $this->clientSecret     = $config['client_secret'];
        $this->clientEmail      = $config['client_email'];
        $this->clientPassword   = $config['client_password'];
        // $this->storeID          = $config['store_id'];
        $this->transactionUtil  = new TransactionUtil();
    }

    public function formatData($id, $request)
    {
        // return $request->pathao_payment_method;
        $sell = $this->transactionUtil->getSingleTransactionWithPayment($id);

        // Required data for Pathao
        $data = [
            'store_id'                 => $request->pathao_store,
            'recipient_name'           => $sell->contact->name,
            'recipient_phone'          => $sell->contact->mobile,
            'recipient_address'        => $sell->shipping_address,
            'recipient_city'           => $request->pathao_recipient_city,
            'recipient_zone'           => $request->pathao_recipient_zone,
            'amount_to_collect'        => $sell->due_amount,
            'delivery_type'            => $request->pathao_delivery_type, // 48 for Normal Delivery, 12 for On Demand Delivery
            'item_type'                => $request->pathao_item_type, //1 for Document, 2 for Parcel
            'item_quantity'            => $request->pathao_item_quantity,
            'item_weight'              => $request->pathao_item_weight, // Float: Minimum 0.5 KG to Maximum 10 kg
        ];

        return $data;
    }

    public function validateData(array $data)
    {
        return PathaoCourierValidator::validate($data);
    }

    public function createOrder(array $data)
    {
        // Get the access token (retrieve from session or refresh if expired)
        $accessToken = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->post("{$this->baseUrl}/aladdin/api/v1/orders", $data);

        if ($response->successful() && $response['code'] == 200) {
            // return $response->json();

            // Get the response data
            $responseData = $response->json();

            // Add the tracking code to the response data
            if (isset($responseData['data']['consignment_id'])) {
                $responseData['tracking_code'] = $responseData['data']['consignment_id'];
                $responseData['tracking_url'] = 'https://merchant.pathao.com/tracking?consignment_id=' . $responseData['data']['consignment_id'];
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
        }
    }


    public function getCities()
    {
        // Get the access token (retrieve from session or refresh if expired)
        $accessToken = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->get("{$this->baseUrl}/aladdin/api/v1/city-list");

        if ($response->successful() && $response['code'] == 200) {
            // Get the cities from response data
            $cities = $response->json();

            // Convert to associative array with city_id as key and city_name as value
            $citiesAssoc = array_column($cities['data']['data'], 'city_name', 'city_id');

            return $citiesAssoc;
        } else {
            throw new \Exception("Error getting access token:\n" . $response);
        }
    }
    
    public function getZones($cityID)
    {
        // Get the access token (retrieve from session or refresh if expired)
        $accessToken = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->get("{$this->baseUrl}/aladdin/api/v1/cities/{$cityID}/zone-list");

        if ($response->successful() && $response['code'] == 200) {
            // Get the cities from response data
            $zones = $response->json();

            // Convert to associative array with city_id as key and city_name as value
            $zonesAssoc = array_column($zones['data']['data'], 'zone_name', 'zone_id');

            return $zonesAssoc;
        }
    }

    public function getStores()
    {
        // Get the access token (retrieve from session or refresh if expired)
        $accessToken = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->get("{$this->baseUrl}/aladdin/api/v1/stores");

        if ($response->successful() && $response['code'] == 200) {
            // Get the cities from response data
            $stores = $response->json();

            // Convert to associative array with city_id as key and city_name as value
            $storesAssoc = array_column($stores['data']['data'], 'store_name', 'store_id');

            return $storesAssoc;
        }
    }
    
    public function getOrderShortInfo($tracking_code)
    {
        // Get the access token (retrieve from session or refresh if expired)
        $accessToken = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->get("{$this->baseUrl}/aladdin/api/v1/orders/{$tracking_code}/info");

        if ($response->successful() && $response['code'] == 200) {
            // Get the cities from response data
            return $response->json();
            $stores = $response->json();

            // Convert to associative array with city_id as key and city_name as value
            $storesAssoc = array_column($stores['data']['data'], 'store_name', 'store_id');

            return $storesAssoc;
        }
    }

    /**
     * Fetch and store the access token in the session
     */
    public function getAccessToken()
    {
        
        // Remove the pathao_access_token from the session
        // Session::forget('pathao_access_token');
        
        // Check if access token exists in session and is not expired
        $accessTokenData = Session::get('pathao_access_token');
        if ($accessTokenData && Carbon::now()->lt(Carbon::parse($accessTokenData['expires_at']))) {
            return $accessTokenData['access_token'];
        }

        // If access token is expired, refresh it
        if ($accessTokenData && isset($accessTokenData['refresh_token'])) {
            return $this->refreshAccessToken($accessTokenData['refresh_token']);
        }

        // Otherwise, request a new access token
        $response = Http::post("{$this->baseUrl}/aladdin/api/v1/issue-token", [
            'client_id'     => $this->clientID,
            'client_secret' => $this->clientSecret,
            'username'      => $this->clientEmail,
            'password'      => $this->clientPassword,
            'grant_type'    => $this->grantType,
        ]);

        if ($response->successful() && isset($response['access_token'])) {
            $this->storeAccessToken($response->json());
            return $response['access_token'];
        }

        throw new \Exception('Unable to fetch access token.');
    }

    /**
     * Refresh the access token using the refresh token
     */
    public function refreshAccessToken($refreshToken)
    {
        $response = Http::post("{$this->baseUrl}/aladdin/api/v1/issue-token", [
            'client_id' => $this->clientID,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
        ]);

        if ($response->successful() && isset($response['access_token'])) {
            $this->storeAccessToken($response->json());
            return $response['access_token'];
        }

        throw new \Exception('Unable to refresh access token.');
    }

    /**
     * Store access token in session
     */
    protected function storeAccessToken(array $tokenData)
    {
        $expiresAt = Carbon::now()->addSeconds($tokenData['expires_in']);
        Session::put('pathao_access_token', [
            'access_token' => $tokenData['access_token'],
            'refresh_token' => $tokenData['refresh_token'],
            'expires_at' => $expiresAt,
        ]);
    }
}
