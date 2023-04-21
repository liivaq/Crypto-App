<?php declare(strict_types=1);

namespace App\Models;

class CryptoCollection
{
    private array $collection;

    public function __construct($data)
    {
        $this->addToCollection($data);
    }

    public function addToCollection($data): void
    {
        foreach ($data as $item) {
            $this->collection[] = new Crypto(
                $item->id,
                $item->name,
                $item->symbol,
                $item->quote->EUR->price);
        }
    }

    public function displayCollection(): void
    {
        /** @var Crypto $crypto */
        foreach ($this->collection as $crypto) {
            echo '══════════════════════════════════' . PHP_EOL;
            echo 'Name: ' . $crypto->getName() . PHP_EOL;
            echo 'Symbol: ' . $crypto->getSymbol() . PHP_EOL;
            echo 'ID: ' . $crypto->getId() . PHP_EOL;
            echo 'Price in EUR: ' . number_format($crypto->getPrice(), 2) . PHP_EOL;
        }
    }
}