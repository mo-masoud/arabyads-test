<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 * Base products class with all needed methods.
 */
abstract class ProductRepository
{
    /**
     * It represent the model here.
     *
     * @var Collection
     */
    protected Collection $collection;

    /**
     * Load JSON file.
     *
     * @param string $dataProvidedFile
     * @return void
     */
    public function loadFile(string $dataProvidedFile): void
    {
        $data = file_get_contents(database_path("jsons/$dataProvidedFile"));
        $this->collection = new Collection(json_decode($data, true));
    }

    /**
     * List all data.
     *
     * @return array
     */
    public function list()
    {
        return $this->collection->toArray();
    }

    /**
     * Merge data with any coming data
     *
     * @param array $items
     * @return void
     */
    public function merge(array $items)
    {
        return $this->collection->merge($items)->toArray();
    }

    /**
     * Check if product in stock or not.
     *
     * @param string $status
     * @return void
     */
    abstract public function inStockFilter(string $status);

    /**
     * Worked on current price not original price.
     *
     * @param float $min
     * @param float $max
     * @return void
     */
    abstract public function priceFiler(float $min, float $max);

    /**
     * Filter on products based on coming request.
     *
     * @return self
     */
    public function filter(): self
    {
        if ($status = request('statusCode')) {
            $this->inStockFilter($status);
        }

        $min = request('balanceMin', 0);
        $max = request('balanceMax', PHP_INT_MAX);
        $this->priceFiler($min, $max);

        return $this;
    }
}
