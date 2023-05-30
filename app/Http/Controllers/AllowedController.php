<?php

namespace App\Http\Controllers;

use App\Services\Allowed_Users\DestroyAllowed;
use App\Services\Allowed_Users\StoreAllowed;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class

AllowedController extends Controller
{
    use JsonRespondController;

    public function store(Request $request): JsonResponse
    {
        try {
            app(StoreAllowed::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            app(DestroyAllowed::class)->execute([
                'id' => $id
            ]);
            return $this->respondObjectDeleted($id);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }

}
