<?php

namespace App\Http\Resources\Answer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends  JsonResource
{
    public function  toArray(Request $request): array
    {
        return [
            'question_id'=>$this->question_id,
            'id'=> $this->id,
            'answer'=> $this->answer,
           'is_correct' => $this->is_correct
        ];
    }
}
