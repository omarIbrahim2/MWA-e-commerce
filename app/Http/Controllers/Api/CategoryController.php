<?php

namespace App\Http\Controllers\Api;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CatAddReq;
use App\Http\Resources\CategoryResource;
use App\Traits\HandleUpload;
use Core\Repositories\CatRepo;
use Core\Services\FileService;

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
        $categories = $this->catRepo->getCats();
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
