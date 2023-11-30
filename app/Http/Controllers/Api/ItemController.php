<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\FileService;
use Core\Repositories\ItemRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequests\ItemAddReq;
use App\Http\Requests\ItemRequests\ItemUpdateReq;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    use HandleUpload;
    
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
    public function store(ItemAddReq $request)
    {
        $data  = $request->validated();
        $data['img'] = $this->handleUpload($request , $this->fileService , null , 'Items');
        $this->itemRepo->createItem($data);

        return response()->json([
            'success' => 'Item added successfully'
        ]);
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
    public function update(ItemUpdateReq $request, $itemId)
    {
        $data = $request->validated();
        $item = $this->itemRepo->getItemById( $itemId );
        $data['img'] = $this->handleUpload($request ,$this->fileService , $item->img , 'Items');
        $action = $this->itemRepo->updateItem($data,$item);
        if ($action) {
            return response()->json([
                'success' => 'Item updated successfully'
            ]);
        }

        return response()->json([
            'fail' => "something wrong happened"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($itemId)
    {
        $item = $this->itemRepo->getItemById( $itemId );
        $action = $item->delete();
        if ($action) {
            if ($item->img) {
                $this->fileService->DeleteFile($item->img);
            }
            return response()->json([
                'success' => 'Item deleted successfully'
            ]);
        }

        return response()->json([
            'fail' => "something wrong happened"
        ]);
    }
}
