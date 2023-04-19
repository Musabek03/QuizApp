<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Validation\ValidationException;

class ShowCategory extends BaseService
{

    public function rules(): array
    {
        return [
            'name'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data):Category
    {

        $this->validate($data);
        return Category::find($data['id']);

    }

}
