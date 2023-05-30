<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\Category\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'code'=> $this->code,
            'name'=> $this->name,
            'description'=> $this->description,
            'user'=> new UserResource($this->user),
            'allowed_type' =>$this->allowed_type,
            'allowed_users' =>UserResource::collection($this->allowedUsers),
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }


}
