<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ShowCategory extends BaseService
{
    public function rules(): array
    {
        return [
            'id'=> 'required|exists:categories,id'
        ];
    }

    /**
     * @throws ModelNotFoundException
     * @throws ValidationException
     */
    public function execute(array $data): Category
    {
        $this->validate($data);
        return Category::where('id', $data['id'])->withTrashed()->first();
    }
}
