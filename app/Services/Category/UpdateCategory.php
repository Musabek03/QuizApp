<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Validation\ValidationException;

class UpdateCategory extends BaseService
{
    public function rules(): array
    {
        return [
            'name'=> 'required|unique:categories,name',
            'id'=> 'required|exists:categories,id',
        ];
    }

    /**
     * @throws ValidationException
     */

    public function execute(array $data): Category
    {
        $this->validate($data);
        $category = Category::find($data['id']);
        $category->update([
            'name'=> $data['name']
        ]);
        return $category;
    }
}
