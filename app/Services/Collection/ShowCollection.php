<?php

namespace App\Services\Collection;

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
    private array $answers;
    public function rules(): array
    {
        return [
            'id'=> 'required|exists:collection,id'
        ];
    }

    /**
     * @throws ValidationException
     * @throws ModelNotFoundException
     */
    public function execute(array $data): array
    {
        $this->validate($data);
        $collection = Collection::findOrFail($data['id']);
        $questions = $collection->questions;
        return [$collection, $questions];
    }
}
