<?php
namespace Core\Repositories;

use App\Models\Product;
use Core\Services\FileService;

class ProductRepo{
    private $fileService;
    public function __construct(FileService $fileService){
        $this->fileService = $fileService;
    }

    public function getProducts(){
        $products = Product::with('item')->paginate(10);
        return $products;
    }

    public function createProduct($data){
        return Product::create($data);
    }

    public function updateProduct($product ,$data){
        return $product->update( $data );
    }

    public function deleteProduct(Product $product){
        
        return $product->delete();
    }
}