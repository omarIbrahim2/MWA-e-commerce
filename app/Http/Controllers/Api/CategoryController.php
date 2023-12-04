<?php

namespace App\Http\Controllers\Api;

use App\Models\Cat;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Repositories\CatRepo;
use Core\Services\FileService;
use App\Http\Requests\CategoryRequests\CatAddReq;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequests\CatUpdateReq;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use HandleUpload;

    private $catRepo , $fileService ;
    public function __construct(FileService $fileService , CatRepo $catRepo)
    {
        $this->fileService = $fileService;
        $this->catRepo = $catRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->catRepo->getCats(3);
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatAddReq $request)
    {
        $data  = $request->validated();
        $data['img'] = $this->handleUpload($request , $this->fileService , null , 'Cats');
        $this->catRepo->createCat($data);

        return response()->json([
            'success' => 'Category added successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cat $category)
    {
        return CategoryResource::make($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CatUpdateReq $request, $catId)
    {
        $data = $request->validated();
        $cat = $this->catRepo->getCatById( $catId );
        $data['img'] = $this->handleUpload($request ,$this->fileService , $cat->img , 'Cats');
        $action = $this->catRepo->updateCat($data,$cat);
        if ($action) {
            return response()->json([
                'success' => 'Category updated successfully'
            ]);
        }

        return response()->json([
            'fail' => "something wrong happened"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($catId)
    {
        $cat = $this->catRepo->getCatById( $catId );
        $action = $cat->delete();
        if ($action) {
            if ($cat->img) {
                $this->fileService->DeleteFile($cat->img);
            }
            return response()->json([
                'success' => 'Category deleted successfully'
            ]);
        }

        return response()->json([
            'fail' => "something wrong happened"
        ]);
    }
}
