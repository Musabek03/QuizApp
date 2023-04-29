<?php

namespace App\Services\User;

use App\Mail\WelcomeMail;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class Register extends BaseService
{

    public function rules(): array
    {
        return [
            'name'=> 'required',
            'phone' => 'required|unique:users,phone',
            'email' => 'nullable|unique:users,email',
            'password'=> 'required',

        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): array
    {
        $this->validate($data);
        $user = User::create([
            'name'=> $data['name'],
            'phone'=> $data['phone'],
            'email'=> $data['email'],
            'password'=> $data['password'],
            'is_premium'=> false,
            'is_admin'=> false,
        ]);
        $token = $user->createToken('user model', ['user'])->plainTextToken;

        $userCode = Mail::to($data['email'])->send(
            new WelcomeMail([
                'name'=> 'Musabekten salem',
              $code =  'code'=> rand(111111, 999999)
            ])
        );

        return [$user, $token, $userCode];
    }


}
