<?php

namespace App\Services\Question;


use App\Models\Question;
use App\Services\BaseService;

class ShowQuestion extends BaseService
{
public function rules(): array
{
    return [

        'id' =>'required|exists:questions,id'
    ];
}

public function execute(array $data)
{
    $this->validate($data);
    $questions =Question::findOrFail($data['id']);
    $answers =$questions->answers;



    return [$questions, $answers];

    }



}
