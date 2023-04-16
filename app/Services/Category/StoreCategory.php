<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Validation\ValidationException;

class StoreCategory extends BaseService
{
    public function rules(): array
    {
        return [
            'name'=> 'required|unique:categories,name',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): Category
    {
        $this->validate($data);

        return Category::create($data);
    }
}
