<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Register extends BaseService
{

    public function rules(): array
    {
        return [
            'name'=> 'required',
            'phone' => 'required|unique:users,phone',
            'password'=> 'required',
            'is_premium' => 'required',
            'is_admin'=> 'required'

        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): User
    {
        $this->validate($data);
        return User::create([
            'name' =>$data['name'],
            'phone' =>$data['phone'],
            'password'=>Hash::make($data['password']),
                'is_premium'=> $data['is_premium'],
                'is_admin'=>$data['is_admin']
        ]);


    }
}
