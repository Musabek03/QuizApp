<?php

namespace App\Services\User;

use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\VerifyCode;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendCode extends BaseService
{

        public function execute()
        {
            $id = Auth::id();
            $user = User::where('id',$id)->first();

            if($user->is_premium == 1)
            {
                return response([
                   $xabar = "Sizde premium jagilgan",

            ]);}
            else
            {
                $code = rand(100000,999999);
                $email = Auth::user()->email;
                VerifyCode::create([
                    'user_id' => $id,
                    'code' => $code,
                    'status' => 'kod jiberildi'
                ]);

                Mail::to($email)->send(
                    new WelcomeMail([
                        'description'=> 'Pochtanizdi tastiyiqlaw ushin',
                        'code'=>  $code
                    ])
                );
                return [
                    $xabar = "Kod jiberildi"
                ];
            }

        }
}
