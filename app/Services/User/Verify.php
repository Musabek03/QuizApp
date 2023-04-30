<?php

namespace App\Services\User;

use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\VerifyCode;
use Illuminate\Support\Facades\DB;

class Verify extends BaseService
{
    public function rules(): array
    {
        return [
            'code' => 'required'
        ];
    }

    public function execute($data)
    {
        $user_id = Auth::id();
        $kod = $data['code'];
        $kod_baza = DB::table('verify_codes')->select('code')->where('user_id',$user_id)->first();
        $manis = VerifyCode::where('user_id', $user_id)->where('attempt', '<', '5')->first();
        if($manis != null )
        {
            $id = $manis['id'];
            $attempt = $manis['attempt'];
            $waqit = $manis['created_at'];
            $h_waqit = Carbon::now()->addMinute(-5);
            $attempt++;

            if($waqit < $h_waqit ){
                $str = "kod waqti pitip qaldi";

            }
            elseif($attempt >5)
            {
                $str =  "urinislar sani 5ewden asip ketti";
            }
            elseif($kod == $manis['code'])
            {
                $str = "duris";
            }
            else
            {
             $str = "manis joq";
            }
            VerifyCode::find($manis['id'])->update([
                'attempt' =>$attempt,
                'status' => $str
            ]);

            if($str == "kod waqti pitip qaldi" || $str == "urinislar sani 5ewden asip ketti"  ){
                VerifyCode::find($manis['id'])->delete();
            }
            if($str == "duris")
            {
                User::find($user_id)->update([
                    'is_premium' => true
                ]);
               // VerifyCode::find($manis['id'])->delete();
            }
        }
        else
        {
            $str = "user tabilmadi";
        }
    return response([
        "xabar" => $str,
    ]);
    }
}
