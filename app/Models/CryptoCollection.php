<?php

namespace App\Models;

class CryptoCollection {
    private array $collection;

    public function __construct($data)
    {
        $this->addToCollection($data);
    }

    public function addToCollection($data){
        foreach ($data as $item){
            $this->collection[] = new Crypto(
                $item->id,
                $item->name,
                $item->symbol,
                $item->quote->USD->price);
        }
    }

    public function getCollection(){
        return $this->collection;
    }
}