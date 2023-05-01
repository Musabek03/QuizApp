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
                $dds = "kod waqti pitip qaldi";

            }
            elseif($attempt >5)
            {
                $dds =  "urinislar sani 5ewden asip ketti";
            }
            elseif($kod == $manis['code'])
            {
                $dds = "duris";
            }
            else
            {
             $dds = "manis joq";
            }
            VerifyCode::find($manis['id'])->update([
                'attempt' =>$attempt,
                'status' => $dds
            ]);

            if($dds == "kod waqti pitip qaldi" || $dds == "urinislar sani 5ewden asip ketti"  ){
                VerifyCode::find($manis['id'])->delete();
            }
            if($dds == "duris")
            {
                User::find($user_id)->update([
                    'is_premium' => true
                ]);
               // VerifyCode::find($manis['id'])->delete();
            }
        }
        else
        {
            $dds = "user tabilmadi";
        }
    return response([
         $dds,
    ]);
    }
}
