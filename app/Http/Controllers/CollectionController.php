<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collection\CollectionCollection;
use App\Http\Resources\Collection\CollectionResource;
use App\Http\Resources\Collection\CollectionWithQuestionsResource;
use App\Services\Collection\DestroyCollection;
use App\Services\Collection\IndexCollection;
use App\Services\Collection\ShowCollection;
use App\Services\Collection\StoreCollection;
use App\Services\Collection\UpdateCollection;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectionController extends Controller
{
    use JsonRespondController;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse|CollectionCollection
    {
        try {
            $collections = app(IndexCollection::class)->execute($request->all());
            return  new CollectionCollection($collections);
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            app(StoreCollection::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            [$collection, $questions] = app(ShowCollection::class)->execute([
                'id'=> $id
            ]);
            return (new CollectionWithQuestionsResource($collection))->setQuestions($questions);
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }catch (ModelNotFoundException){
            return $this->respondNotFound();
        }catch (Exception $exception){
            $this->setHTTPStatusCode($exception->getCode());
            return $this->respondWithError($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $collection = app(UpdateCollection::class)->execute([
                'id'=>$id,
                'name'=>$request->name,
                'description' => $request->description

            ]);
            return new CollectionResource($collection);
        }catch (Exception $exception){
            $this->setHTTPStatusCode($exception->getCode());
            return $this->respondWithError($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $collection = app(DestroyCollection::class)->execute([
                'id'=>$id
            ]);
            return response(
                [
                    'successful'=>true
                ]);

        }catch (ValidationException $a){
            return response("Bunday id li collection tabilmadi");
        }
    }
}
