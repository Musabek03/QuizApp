<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

class UpdateCategory extends BaseService
{

    public function rules(): array
    {
        return [
            'name' => 'required',
            'id'=> 'required|exists:categories,id'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data ): Category
    {

        $this->validate($data);


        $updateData =
            [
                'name' => $data['name']
            ];

        $categories = Category::find($data['id']);

        $categories->update($updateData);

        return $categories;

    }
}
