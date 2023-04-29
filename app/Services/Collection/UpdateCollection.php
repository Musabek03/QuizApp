<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseService;
use Illuminate\Validation\ValidationException;

class UpdateCollection extends BaseService
{



    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'id'=> 'required|exists:collection,id'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data ): Collection
    {

        $this->validate($data);


        $updateData =
            [
                'name' => $data['name'],
                'description' => $data['description']
            ];

        $collection = Collection::find($data['id']);

        $collection->update($updateData);

        return $collection;

    }

}
