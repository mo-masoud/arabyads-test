<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(private ProductService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->successResponse(
            data: $this->service->list()
        );
    }
}
