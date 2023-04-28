<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'name'=> $this->name,
            'phone'=> $this->phone,
            'is_premium' => $this->is_premium,
            'is_admin' => $this->is_admin,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}
