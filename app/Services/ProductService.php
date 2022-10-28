<?php

namespace App\Services;

use App\Repositories\DataProviderXRepository;
use App\Repositories\DataProviderYRepository;

class ProductService
{

    public function __construct(
        private readonly DataProviderXRepository $repoX,
        private readonly DataProviderYRepository $repoY,
    ) {
    }

    /**
     * List all products and apply some filters.
     *
     * @return array
     */
    public function list()
    {
        $provider = request('provider');
        if ($provider === 'DataProviderX') {
            return $this->repoX->filter()->list();
        } else if ($provider === 'DataProviderY') {
            return $this->repoY->filter()->list();
        }

        return $this->repoX->filter()->merge($this->repoY->filter()->list());
    }
}
