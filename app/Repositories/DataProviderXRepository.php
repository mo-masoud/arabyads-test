<?php

namespace App\Repositories;

class DataProviderXRepository extends ProductRepository
{
    public function __construct()
    {
        $this->loadFile('DataProviderX.json');
    }

    public function inStockFilter(string $status)
    {
        $this->collection = $this->collection->where('StatusCode', $status === 'instock' ? 1 : 2)->values();
    }

    public function priceFiler(float $min, float $max)
    {
        $this->collection = $this->collection->where('ProductCurrentPrice', '>=', $min)
            ->where('ProductCurrentPrice', '<=', $max)
            ->values();
    }
}
