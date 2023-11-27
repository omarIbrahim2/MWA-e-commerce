<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Core\Services\FileService;
use Core\Repositories\ProductRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    private $productRepo , $fileService ;
    public function __construct(ProductRepo $productRepo , FileService $fileService ){
        $this->productRepo = $productRepo ;
        $this->fileService = $fileService ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepo->getProducts();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
