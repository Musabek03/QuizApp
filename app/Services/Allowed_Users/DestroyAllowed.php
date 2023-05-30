<?php

namespace App\Services\Allowed_Users;


use App\Models\AllowedUser;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class DestroyAllowed extends BaseService
{
public function rules(): array
{
    return [
        'id'=> 'required|exists:allowed_users,id',
    ];
}

public function execute(array $data)
{

    $this->validate($data);

   $delete =  DB::table('allowed_users')->find($data['id']);
   $delete->delete();
    return true;


    }



}
