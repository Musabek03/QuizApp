<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseService;
use Illuminate\Validation\ValidationException;
class DestroyCollection extends BaseService
{
    public function rules(): array
    {
        return [
            'id'=> 'required|exists:collection,id'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): bool
    {
        $this->validate($data);
        $category = Collection::find($data['id']);
        $category->delete();
        return true;
    }
}
