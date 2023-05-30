<?php

namespace App\Services\Result;


use App\Models\Result;
use App\Services\BaseService;

class IndexResult extends BaseService
{

    public function rules(): array
{
    return [
        'search'=>'nullable'
    ];
}

    public function execute($data)
{
    return Result::when($data['search'] ?? null, function($query,$search){
        $query->search($search);
    })->paginate(15);
}





}
