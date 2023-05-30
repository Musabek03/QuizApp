<?php

namespace App\Services\Allowed_Users;


use App\Models\AllowedUser;
use App\Services\BaseService;
use Illuminate\Validation\ValidationException;

class StoreAllowed extends BaseService
{
public function rules(): array
{
    return [
        'user_id' => 'required|exists:users,id',
        'collection_id' => 'required|exists:collection,id'
    ];
}

public function execute(array $data)
{

    $this->validate($data);

    $allowed=AllowedUser::where('user_id',$data['user_id'])->where('collection_id',$data['collection_id']);
    if($allowed==null){
        AllowedUser::create([
            'user_id'=>$data['user_id'],
            'collection_id'=>$data['collection_id'],
        ]);
    }else{
        return "This is allowed user is exists";
    }
    return true;
}






}
