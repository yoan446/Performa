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
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'email'=> $this->email,
            'email_verified_at'=> $this->id,
            'remenber_token'=> $this->remenber_token,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'secondname'=> $this->secondname,
            'user_job_name'=> $this->user_job_name,
            'direction_id'=> $this->direction_id,
            'statut_user'=> $this->statut_user,
            'role_user'=> $this->role_user,
            'manager_id'=> $this->manager_id,
        ];
    }
}
