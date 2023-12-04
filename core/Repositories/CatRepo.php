<?php
namespace Core\Repositories;

use App\Models\Cat;
use Core\Services\FileService;

class CatRepo{
    private $fileService;
    public function __construct(FileService $fileService){
        $this->fileService = $fileService;
    }

    public function getCats($pages){
        $categories = Cat::select('id','catName' , 'img')->paginate($pages);
        return $categories;
    }

    public function getCatById($id){
        $cat = Cat::findOrFail($id);
        return $cat;
    }

    public function createCat($data){
        return Cat::create($data);
    }

    public function updateCat($data , $cat){

        return $cat->update($data);
    }
}