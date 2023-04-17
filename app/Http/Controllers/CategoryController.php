<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\Category\DestroyCategory;
use App\Services\Category\IndexCategory;
use App\Services\Category\ShowCategory;
use App\Services\Category\StoreCategory;
use App\Services\Category\UpdateCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = app(IndexCategory::class)->execute([]);
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $category = app(StoreCategory::class)->execute($request->all());
            return new CategoryResource($category);
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response|CategoryResource
    {
        try {
            $category = app(ShowCategory::class)->execute([
                'id'=> $id
            ]);
            return new CategoryResource($category);
        }catch (ModelNotFoundException){
            return response([
                'error'=> 'Category not found'
            ], 404);
        }catch (ValidationException $e){
            return response([
                'errors'=> $e->validator->errors()->all()
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): Response|CategoryResource
    {
        try {
            $category = app(UpdateCategory::class)->execute([
                'id'=> $id,
                'name'=> $request->name,
            ]);
            return new CategoryResource($category);
        }catch (ValidationException $e){
            return response([
                'errors'=> $e->validator->errors()->all()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = app(DestroyCategory::class)->execute([
                'id'=> $id,
            ]);
            return response([
                'successful'=> true
            ]);
        }catch (ValidationException $e){
            return response([
                'errors'=> $e->validator->errors()->all()
            ], 422);
        }
    }
}
