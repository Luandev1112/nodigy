<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\SupportedWallet;

class SupportedWalletResource extends JsonResource
{    
    public function toArray($request)
    {
        $status = SupportedWallet::$status;
        
        return [
            'id' => $this->id,
            'supp_wallet_name' => $this->supp_wallet_name,            
            'wallet_sno' => $this->wallet_sno,
            'network_id' => $this->network_id,
            'network_name' => $this->network_name,
            'wallet_logo' => ($this->wallet_logo)? $this->getImageUrl() :"",
            'supp_wallet_status' => $this->supp_wallet_status,
            'supp_wallet_status_text' => (isset($status[$this->supp_wallet_status]))? $status[$this->supp_wallet_status]:"",            
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
