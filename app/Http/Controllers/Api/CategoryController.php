<?php

namespace App\Http\Controllers\Api;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CatAddReq;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Cat::select('id','catName')->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatAddReq $request)
    {
       
        $data  = $request->validated();

        
        Cat::create($data);

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
