<?php
namespace Core\Repositories;

use App\Models\Cat;
use Core\Services\FileService;

class CatRepo{
    private $fileService;
    public function __construct(FileService $fileService){
        $this->fileService = $fileService;
    }

    public function getCats(){
        $categories = Cat::select('id','catName')->get();
        return $categories;
    }

    public function createCat($data){
        return Cat::create($data);
    }
}