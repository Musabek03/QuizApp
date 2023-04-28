<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseService;

class UpdateCollection extends BaseService
{

        public function rules(): array
        {
            return [
            'name' => 'required|unique:collection,name',
                'description' =>'required',
            ];
        }

        public function  execute(array $data): Collection
        {
            $this->validate($data);
            $collection = Collection::find($data['id']);
            $collection->update([
                'name'=> $data['name'],
                'description'=> $data['description']
            ]);
            return $collection;

        }
}
