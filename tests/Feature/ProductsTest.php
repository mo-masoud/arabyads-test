<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * Test list all products without any fitters.
     *
     * @return void
     */
    public function test_list_all()
    {
        $response = $this->get('/api/v1/products');
        $response->assertStatus(200);
    }

    /**
     * Test list all products x without any fitters.
     *
     * @return void
     */
    public function test_list_all_data_x()
    {
        $response = $this->get('/api/v1/products?provider=DataProviderX');
        $response->assertJsonStructure([
            [
                'ProductIdentification',
                'ProductName',
                'ProductCurrency',
                'ProductOriginalPrice',
                'ProductCurrentPrice',
                'StatusCode',
                'IncludeVAT',
                'OfferEndDate',
                'IBAN'
            ]
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test list all products y without any fitters.
     *
     * @return void
     */
    public function test_list_all_data_y()
    {
        $response = $this->get('/api/v1/products?provider=DataProviderY');
        $response->assertJsonStructure([
            [
                "id",
                "name",
                "currency",
                "original_price",
                "current_price",
                "status",
                "include_VAT",
                "end_date",
                "IBAN",
            ]
        ]);
        $response->assertStatus(200);
    }
}
