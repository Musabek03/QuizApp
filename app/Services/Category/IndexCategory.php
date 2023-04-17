<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class IndexCategory extends BaseService
{
    public function rules(): array
    {
        return [];
    }

    public function execute(array $data): Collection
    {
        return Category::all(['id', 'name', 'created_at', 'updated_at']);
    }
}
