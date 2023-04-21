<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\ApiClient;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$amount = (int)readline('Enter amount of cryptos you want to see: ');
$cryptoCollection = (new ApiClient($_ENV['COIN_MARKET_CAP_API']))->getLatest($amount);

if(!$cryptoCollection){
    echo 'Wrong input'.PHP_EOL;
}else{
    $cryptoCollection->displayCollection();
}