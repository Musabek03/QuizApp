<?php

namespace App\Http\Controllers;

use App\Services\User\SendCode;
use App\Services\User\Verify;
use App\Traits\JsonRespondController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmailController extends Controller
{
    use JsonRespondController;

    public function  SendCode(Request $request)
    {
        try {
            app(SendCode::class)->execute($request->all());
            return response([
                'kod jiberildi!'
            ]);
        } catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }

    }
    public function VerifyCode(Request $request)
    {
        try {
            app(Verify::class)->execute($request->all());
        } catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }
}
