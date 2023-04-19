<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\UpdateResource;
use App\Models\Category;
use App\Models\User;
use App\Services\Category\DeleteCategory;
use App\Services\Category\IndexCategory;
use App\Services\Category\ShowCategory;
use App\Services\Category\StoreCategory;
use App\Services\Category\UpdateCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\StrictSessionHandler;

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
    public function show(string $id)
    {
        try {
            $categories = app(ShowCategory::class)->execute([
                'id'=>$id
            ]);
            return new CategoryResource($categories);
        }
        catch (ModelNotFoundException){
            return response([
                'error'=> 'Category not found'
            ], 404);

        }



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id):Response|CategoryResource
    {
        try {
            $categories = app(UpdateCategory::class)->execute([
            'id'=>$id,
            'name'=>$request->name
            ]);
            return new CategoryResource($categories);
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete( String $id)
    {

        try {
            $categories = app(DeleteCategory::class)->execute([
                'id'=>$id
            ]);
            return response(
                [
                    'successful'=>true
                ]);

        }catch (ValidationException $a){
return response("Bunday id li categoriya tabilmadi");
        }

    }
}
