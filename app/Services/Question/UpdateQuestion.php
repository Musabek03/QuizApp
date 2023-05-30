<?php

namespace App\Services\Question;


use App\Models\Answer;
use App\Models\Collection;
use App\Models\Question;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use function GuzzleHttp\Promise\all;

class UpdateQuestion extends BaseService
{
    public function rules(): array
    {
        return [
            "collection_id" => 'required|exists:collection,id',
            "questions.*.question" => "required_unless:questions,null",
            "questions.*.answers" => "required_unless:questions,null",
            "questions.*.answers.*.answer" => "required_unless:questions,null",
            "questions.*.answers.*.is_correct" => "required_unless:questions,null|boolean",
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        $question = Question::findOrfail($data['question_id']);
        $oldAnswers  = $question->answers->pluck('answer');
        $answers = collect($question['answers']);

        $question->update([
            'question' => $question['question'],
            'correct_answers' =>$answers->where('is_correct', true)->count(),
        ]);
        foreach ($answers as $answer) {
            if (!in_array($answer['answer'], $oldAnswers)){
               $this->$answers[] = [
                   'question_id' => $question->id,
                   'answer' => $answer['answer'],
                   'is_correct' => $answer['is_correct'],
               ];
            }
        }

        if (!empty($this->answers)){
            DB::table('answers')->insert($this->answers);
        }
return true;


}
}
