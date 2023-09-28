<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Node;

class NodeResource extends JsonResource
{
    public function toArray($request)
    {
        $status = Node::$nodeStatus;
        $nodeType = Node::$nodeType;

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
            'server_id' => $this->server_id,
            'user_wallet_id' => $this->user_wallet_id,
            'node_name' => $this->node_name,
            'node_url' => $this->node_url,
            'node_logo' => ($this->node_logo)? $this->getImageUrl() :"",
            'node_status' => $this->node_status,
            'node_status_text' => (isset($status[$this->node_status]))? $status[$this->node_status]:"",
            'node_type' => $this->node_type,
            'node_type_text' => (isset($nodeType[$this->node_type]))? $nodeType[$this->node_type]:"",
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
