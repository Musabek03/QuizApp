<?php

namespace App\Services\Allowed_Users;


use App\Models\AllowedUser;
use App\Services\BaseService;

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

    AllowedUser::find($data['id'])->delete();
    return true;


    }



}
