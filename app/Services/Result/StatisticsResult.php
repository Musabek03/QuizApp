<?php

namespace App\Services\Result;


use App\Models\Result;
use App\Services\BaseService;

class StatisticsResult extends BaseService
{
public function rules(): array
{
    return [];
}

public function execute(array $data)
{

    $this->validate($data);
    return Result::all('id', 'collection_id', 'question_id', 'answer_id', 'is_correct');

    }



}
