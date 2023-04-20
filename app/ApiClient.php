<?php declare(strict_types=1);

namespace App;

use App\Models\CryptoCollection;
use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;
    private string $apiKey;

    public function __construct($apiKey)
    {
        $this->client = new Client();
        $this->apiKey = $apiKey;
    }

    public function getLatest($userInput): CryptoCollection
    {
        $response = $this->client->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
                'headers' => [
                    "Accepts" => " application/json",
                    "X-CMC_PRO_API_KEY" => $this->apiKey
                ],
                'query' => [
                    'start' => '1',
                    'limit' => $userInput,
                    'convert' => 'EUR'
                ]
            ]
        );
        return new CryptoCollection(json_decode($response->getBody()->getContents())->data);
    }
}