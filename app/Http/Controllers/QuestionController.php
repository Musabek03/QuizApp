<?php

namespace App\Http\Controllers;

use App\Http\Resources\Questions\QuestionResource;
use App\Models\Question;
use App\Services\Question\DestroyQuestion;
use App\Services\Question\IndexQuestion;
use App\Services\Question\ShowQuestion;
use App\Services\Question\StoreQuestion;
use App\Services\Question\UpdateQuestion;
use App\Traits\JsonRespondController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{
    use JsonRespondController;

    public function index()
    {
        $questions = app(IndexQuestion::class)->execute([]);
        return QuestionResource::collection($questions);
    }


    public function show(string $id)
    {
        try {
            [$questions, $answers] = app(ShowQuestion::class)->execute([
                'id' => $id
            ]);
            return (new QuestionResource($questions))->setQuestions($answers);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (ModelNotFoundException) {
            return $this->respondNotFound();
        } catch (Exception $exception) {
            $this->setHTTPStatusCode($exception->getCode());
            return $this->respondWithError($exception->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $questions = app(StoreQuestion::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function update(Request $request, string $id): JsonResource|JsonResponse
    {
        try{
       app(UpdateQuestion::class)->execute($request->all());
            return $this->respondSuccess();
        }  catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function destroy(string $id)
    {
        try{
        app(DestroyQuestion::class)->execute([
            'id'=>$id
        ]);
        return $this->respondObjectDeleted($id);
    }catch (ValidationException $exception) {
        return $this->respondValidatorFailed($exception->validator);
    } catch (Exception $exception) {
        return $this->respondNotFound();
    }
    }


}
