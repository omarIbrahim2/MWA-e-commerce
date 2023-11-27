<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use Core\Services\FileService;
use Core\Repositories\ItemRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    private $fileService , $itemRepo ;

    public function __construct(FileService $fileService , ItemRepo $itemRepo ){
        $this->fileService = $fileService ;
        $this->itemRepo = $itemRepo ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemRepo->getItems();
        return ItemResource::collection($items);
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
    public function show(Item $item)
    {
        return ItemResource::make($item);
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
