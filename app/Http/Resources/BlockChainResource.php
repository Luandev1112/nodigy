<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\BlockChain;

class BlockChainResource extends JsonResource
{    
    public function toArray($request)
    {
        $status = BlockChain::$status;
        $chainType = BlockChain::$chainType;

        return [
            'id' => $this->id,
            'chain_name' => $this->chain_name,
            'chain_token' => $this->chain_token,
            'network_id' => $this->network_id,
            'network_name' => $this->network_name,
            'chain_id' => $this->chain_id,
            'chain_hexa_id' => $this->chain_hexa_id,
            'chain_logo' => ($this->chain_logo)? $this->getImageUrl() :"",
            'chain_status' => $this->chain_status,
            'chain_status_text' => (isset($status[$this->chain_status]))? $status[$this->chain_status]:"",
            'chain_type' => $this->chain_type,
            'chain_type_text' => (isset($chainType[$this->chain_type]))? $chainType[$this->chain_type]:"",
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
