<?php

namespace App\Services\Category;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Collection;
use App\Services\BaseService;


class IndexCategory extends BaseService
{
        public function rules(): array
        {
            return [];
        }

        public function execute(array $data): \Illuminate\Database\Eloquent\Collection
        {
        return Category::all(['id', 'name', 'created_at', 'updated_at']);
        }
}

