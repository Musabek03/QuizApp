<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\UserResource;
use App\Services\User\Register;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        try {
        $register = app(Register::class)->execute([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => $request->password,
            'is_premium' => $request->is_premium,
            'is_admin' => $request->is_admin
        ]);
    return  new UserResource($register);
        }
        catch (ValidationException $exception)
        {
            return $exception->validator->errors()->all();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
