<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Project;

class ProjectResource extends JsonResource
{    
    public function toArray($request)
    {
        $status = Project::$status;
        
        return [
            'id' => $this->id,
            'project_name' => $this->project_name,
            'project_token' => $this->project_token,
            'project_sno' => $this->project_sno,
            'network_id' => $this->network_id,
            'network_name' => $this->network_name,
            'chain_id' => $this->chain_id,
            'chain_name' => $this->chain_name,
            'supp_wallet_id' => $this->supp_wallet_id,
            'supp_wallet_name' => $this->supp_wallet_name,
            'twitter_url' => $this->twitter_url,
            'project_website' => $this->project_website,
            'image' => ($this->image)? $this->getImageUrl() :"",
            'project_status' => $this->project_status,
            'project_status_text' => (isset($status[$this->project_status]))? $status[$this->project_status]:"",            
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
