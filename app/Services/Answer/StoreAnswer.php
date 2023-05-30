<?php

namespace App\Services\Answer;


use App\Models\Answer;
use App\Models\Question;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class StoreAnswer extends BaseService
{
public function rules(): array
{
    return [
        'question_id' => 'required|exists:questions,id',
        'answer' => 'required',
        'is_correct' => 'required|boolean',
    ];
}

    public function execute($data): bool
    {
        $this->validate($data);
        Answer::create([
            'question_id' => $data['question_id'],
            'answer' => $data['answer'],
            'is_correct' =>$data['is_correct'],
        ]);


        return true;




    }

}
