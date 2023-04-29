<?php

namespace App\Services\Collection;

use App\Models\Answer;
use App\Models\Collection;
use App\Models\Question;
use App\Services\BaseService;
use Faker\Provider\Base;
use Illuminate\Validation\ValidationException;

class DestroyCollection extends BaseService
{
    public function rules():array
    {
        return [
            'id' =>'required|exists:collection,id'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): bool
    {
        $this->validate($data);

        $collection =Collection::find($data['id']);

        $questions = Question::where('collection_id',$data['id'])->get();
        foreach ($questions as $question)
        {
        $answers  = Answer::where('question_id',$question['id'])->get();
        foreach ($answers as $answer)
        {
            Answer::find($answer['id'])->delete();
        }
        Question::find($question['id'])->delete();
        }
        $collection->delete();
        return true;
    }
}
