<?php

namespace App\Http\Resources\Result;

use App\Http\Resources\Answer\AnswerResource;
use App\Http\Resources\Collection\CollectionResource;
use App\Http\Resources\Questions\QuestionResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'collection_id'=>$this->collection_id,
            'question_id'=>$this->question_id,
            'user_id'=>$this->user_id,
            'answer_id'=>$this->answer_id,
            'is_correct'=>$this->is_correct,
            'created_at'=> $this->created_at->format('Y-m-d H:i:s'),

        ];
    }
}
