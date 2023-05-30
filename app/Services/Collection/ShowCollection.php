<?php

namespace App\Services\Collection;

use App\Http\Resources\Collection\CollectionCollection;
use App\Models\Collection;
use App\Models\Question;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ShowCollection extends BaseService
{
    public function rules(): array
    {
        return [
            'id' =>'required|exists:collection,id'
        ];

    }

    public function execute($data)
    {
        $this->validate($data);
        $collection =Collection::findOrFail($data['id']);
        $questions =$collection->questions;



        return [$collection, $questions];
    }
}
