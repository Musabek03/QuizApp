<?php

namespace App\Services\Question;


use App\Models\Question;
use App\Services\BaseService;

class IndexQuestion extends BaseService
{
    public function rules(): array
    {
        return [];
    }

    public function execute(array $data)
    {

        $this->validate($data);

        return Question::all( 'id','question', 'correct_answers', 'created_at', 'updated_at');



    }



}
