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

    public function getCollection(): array
    {
        return $this->collection;
    }
}