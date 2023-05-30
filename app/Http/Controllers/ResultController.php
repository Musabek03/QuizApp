<?php

namespace App\Http\Controllers;

use App\Http\Resources\Result\ResultCollection;
use App\Services\Result\IndexResult;
use App\Services\Result\StatisticsResult;
use App\Services\Result\storeResult;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class ResultController extends Controller
{
    use JsonRespondController;

    public function index(Request $request): JsonResource|JsonResponse
    {
        try {
            $results = app(IndexResult::class)->execute($request);
            return new ResultCollection($results);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }

    public function statistics(Request $request, string $collection_id, string $question_id)
    {
        try {
            app(StatisticsResult::class)->execute([
                'collection_id' => $collection_id,
                'question_id' => $question_id,
                'answer_id' => $request->answer_id,
                'is_correct' =>$request->is_correct,
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }



}
