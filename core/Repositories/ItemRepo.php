<?php
namespace Core\Repositories;

use App\Models\Item;
use Core\Services\FileService;

class ItemRepo{
    private $fileService;
    public function __construct(FileService $fileService){
        $this->fileService = $fileService;
    }

    public function getItems(){
        $items = Item::with('cat')->select('id' , 'cat_id' , 'itemName' , 'img')->paginate(10);
        return $items;
    }

    public function getItemById($id){
        $item = Item::findOrFail($id);
        return $item;
    }
    public function createItem($data){
        return Item::create($data);
    }

    public function updateItem($data , $item){

        return $item->update($data);
    }
}