<?php declare(strict_types=1);

namespace App;
use App\Models\CryptoCollection;
use GuzzleHttp\Client;
use Dotenv\Dotenv;

class ApiClient{
    private Client $client;
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->client = new Client();
        $this->apiKey = $apiKey;
    }

    public function getData(){
        $parameters = [
            'start' => '1',
            'limit' => '10'
        ];

        $headers = [
            "Accepts" => " application/json",
            "X-CMC_PRO_API_KEY" => $this->apiKey
        ];

        $response = $this->client->get( 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
                'headers' => $headers,
                'query' => $parameters
            ]
        );
        $data = json_decode($response->getBody()->getContents());
        return new CryptoCollection($data->data);
    }
}