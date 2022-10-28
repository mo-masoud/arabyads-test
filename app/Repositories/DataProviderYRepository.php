<?php

namespace App\Repositories;

class DataProviderYRepository extends ProductRepository
{
    public function __construct()
    {
        $this->loadFile('DataProviderY.json');
    }

    public function inStockFilter(string $status)
    {
        $this->collection = $this->collection->where('status', $status === 'instock' ? 1 : 2)->values();
    }

    public function priceFiler(float $min, float $max)
    {
        $this->collection = $this->collection->where('current_price', '>=', $min)
            ->where('current_price', '<=', $max)
            ->values();
    }
}
