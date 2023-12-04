<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\FileService;
use Core\Repositories\ProductRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequests\ProductAddReq;
use App\Http\Requests\ProductRequests\ProductUpdateReq;

class ProductController extends Controller
{
    use HandleUpload;
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
    public function store(ProductAddReq $request)
    {
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request , $this->fileService , null , 'Products');
        $action = $this->productRepo->createProduct($data);
        if($action){
            return response()->json([
                'success' => 'Product added successfully'
            ]);
        }

        return response()->json([
            'fail' => "something wrong happened"
        ]);
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
    public function update(ProductUpdateReq $request, Product $product)
    {
        dd($product);
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , $product->img , 'Products');
        $action = $this->productRepo->createProduct($product ,$data);
        if($action){
            return response()->json([
                'success' => 'Product updated successfully'
            ]);
        }

        return response()->json([
            'fail' => "something wrong happened"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->img) {
            $this->fileService->DeleteFile($product->img);
        }
        $action = $this->productRepo->deleteProduct($product);
        if($action){
            return response()->json([
                'success' => 'Product deleted successfully'
            ]);
        }

        return response()->json([
            'fail' => "something wrong happened"
        ]);
    }
}
