<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'verified' => $this->verified_at ? "VERIFIED": "VERIFICATION PENDING",
            'verified_at' => $this->verified_at,
            'is_banned' => $this->is_banned,
            'role' => $this->currentRole,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
