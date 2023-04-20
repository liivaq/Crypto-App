<?php declare(strict_types=1);

use App\Models\Crypto;
use Dotenv\Dotenv;

require_once 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$cryptoInfo = new \App\ApiClient($_ENV['COIN_MARKET_CAP_API']);
$amount = readline('Enter amount of cryptos you want to see: ');
$cryptoCollection = $cryptoInfo->getLatest($amount)->getCollection();

/** @var Crypto $crypto */
foreach ($cryptoCollection as $crypto) {
    echo '══════════════════════════════════' . PHP_EOL;
    echo 'Name: ' . $crypto->getName() . PHP_EOL;
    echo 'Symbol: ' . $crypto->getSymbol() . PHP_EOL;
    echo 'ID: ' . $crypto->getId() . PHP_EOL;
    echo 'Price in EUR: ' . number_format($crypto->getPrice(), 2) . PHP_EOL;
}


