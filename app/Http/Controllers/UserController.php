<?php

namespace App\Http\Controllers;

use App\Services\User\Login;
use App\Services\User\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        try {
            [$user , $token] = app(Register::class)->execute($request->all());
            return response([
                'data'=> [
                    'id'=>$user->id,
                    'name' => $user->name,
                    'phone' =>$user->phone,
                    'email' => $user->email,
                    'token' =>$token,
                ]
            ]);
        }catch ( ValidationException $exception)
        {
        return response([
            'errors' =>$exception->validator->errors()->all()
        ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        $user = Auth::user();
        return response([
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'nameAndPhone' => $user->nameAndPhone
        ]);
    }

    public function signIn(Request $request)
    {
        try {
            [$user, $token, $role] = app(Login::class)->execute($request->all());
            return [
                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'role' => $role,

                ]
            ];
        } catch (ValidationException $exception) {
            return response([
                'errors' => $exception->validator->errors()->all()
            ], 422);
        } catch (\Exception $exception) {
            if ($exception->getCode() == 401) {
                return response([
                    'error' => $exception->getMessage()
                ], $exception->getCode());
            }
        }
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
