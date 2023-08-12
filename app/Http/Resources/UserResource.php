<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'user_id' => $this->id,
        'name' => $this -> name,
        'email' => $this -> email,
        'token' => $this ->createToken("Token")->plainTextToken,
        'role' =>$this ->roles->pluck('name') ?? [],
        'role.permissions' => $this -> getPermissionsViaRoles()->pluck('name') ?? [],
        'permissions' => $this -> permissions -> pluck('name') ?? [],
        ];
        
    }
}
