<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Network;

class NetworkResource extends JsonResource
{    
    public function toArray($request)
    {
        $status = Network::$status;

        return [
            'id' => $this->id,
            'network_name' => $this->network_name,
            'network_sno' => $this->network_sno,
            'network_logo' => ($this->network_logo)? $this->getImageUrl() :"",
            'network_status' => $this->network_status,
            'network_status_text' => (isset($status[$this->network_status]))? $status[$this->network_status]:"",
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
