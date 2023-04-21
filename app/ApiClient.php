<?php declare(strict_types=1);

namespace App;

use App\Models\CryptoCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiClient
{
    private Client $client;
    private string $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = $_ENV['COIN_MARKET_CAP_API'];
    }

    public function getLatest($userInput): ?CryptoCollection
    {
        try {
            $response = $this->client->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest',
                [
                    'headers' => [
                        "Accepts" => " application/json",
                        "X-CMC_PRO_API_KEY" => $this->apiKey
                    ],
                    'query' => [
                        'limit' => $userInput,
                        'convert' => 'EUR'
                    ]
                ]
            );
            return new CryptoCollection(json_decode($response->getBody()->getContents())->data);
        } catch (GuzzleException $e) {
            $e->getMessage();
        }
        return null;
    }
}