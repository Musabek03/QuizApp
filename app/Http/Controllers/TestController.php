<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        Mail::to('muxaddeskalenderova@gmail.com')->send(
            new WelcomeMail([
                'name'=> 'Musabekten salem',
                'code'=> 5555
            ])
        );
        return [
            'success'=> true
        ];
    }
}
