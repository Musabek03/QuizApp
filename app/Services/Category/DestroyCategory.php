<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Validation\ValidationException;

class DestroyCategory extends BaseService
{
    public function rules(): array
    {
        return [
            'id'=> 'required|exists:categories,id'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): bool
    {
        $this->validate($data);
        $category = Category::find($data['id']);
        $category->delete();
        return true;
    }
}
