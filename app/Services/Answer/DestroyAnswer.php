<?php

namespace App\Services\Answer;


use App\Models\Answer;
use App\Models\Question;
use App\Services\BaseService;

class DestroyAnswer extends BaseService
{
public function rules(): array
{
    return [
        'id' => 'required|exists:answers,id'
    ];
}

public function execute(array $data)
{

    $this->validate($data);

   $answers = Answer::find($data['id']);
   $answers->delete();



    }



}
