<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\User;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $status = User::$status;

        return [
            'view_id' => $this->getUserID(),
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'balance' => $this->balance,
            'status' => $this->status,
            'status_text' => (isset($status[$this->status]))? $status[$this->status]:"",
            'is_email_verified' => $this->email_verified_at? true:false,
            'email_verified_at' => $this->email_verified_at? date('d/m/Y H:i:s', strtotime($this->email_verified_at)):"",
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}