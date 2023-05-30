<?php

namespace App\Http\Controllers;

use App\Http\Resources\Result\ResultCollection;
use App\Services\Result\IndexResult;
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
}
