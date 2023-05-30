<?php

namespace App\Http\Controllers;

use App\Http\Resources\Answer\AnswerResource;
use App\Http\Resources\Questions\QuestionResource;
use App\Services\Answer\DestroyAnswer;
use App\Services\Answer\IndexAnswer;
use App\Services\Answer\ShowAnswer;
use App\Services\Answer\StoreAnswer;
use App\Services\Answer\UpdateAnswer;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AnswerController extends Controller
{
    use JsonRespondController;

    public function index()
    {
        $answers = app(IndexAnswer::class)->execute([]);
        return AnswerResource::collection($answers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
             app(StoreAnswer::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    /**
     * Display the specified resource.
     */
//    public function show(string $id)
//    {
//
//        try {
//             $answers = app(ShowAnswer::class)->execute([
//                'id' => $id,
//            ]);
//            return new AnswerResource($answers);
//        } catch (ValidationException $exception) {
//            return $this->respondValidatorFailed($exception->validator);
//        } catch (ModelNotFoundException) {
//            return $this->respondNotFound();
//        } catch (Exception $exception) {
//            $this->setHTTPStatusCode($exception->getCode());
//            return $this->respondWithError($exception->getMessage());
//        }
//    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, string $id)
//    {
//        try{
//            $answer = app(UpdateAnswer::class)->execute([
//                'id'=>$id,
//                'answer'=>$request->answer,
//
//            ]);
//            return new AnswerResource($answer);
//        } catch (Exception $exception) {
//            return $this->respondNotFound();
//        }
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try{
            app(DestroyAnswer::class)->execute([
                'id'=>$id,
            ]);
            return $this->respondObjectDeleted($id);
        }catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }
}
