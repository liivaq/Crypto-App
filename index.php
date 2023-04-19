<?php

use App\Models\Crypto;
use Dotenv\Dotenv;

require_once 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$data = new \App\ApiClient($_ENV['COIN_MARKET_CAP_API']);
$collection = $data->getData()->getCollection();
//var_dump($collection);

/** @var Crypto $crypto */
foreach ($collection as $crypto){
    echo '══════════════════════════════════'.PHP_EOL;
    echo 'Name: '. $crypto->getName().PHP_EOL;
    echo 'Symbol: '. $crypto->getSymbol().PHP_EOL;
    echo 'ID: '. $crypto->getId().PHP_EOL;
    echo 'Price in USD: '. $crypto->getPrice().PHP_EOL;
}