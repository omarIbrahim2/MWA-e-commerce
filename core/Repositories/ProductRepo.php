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
}