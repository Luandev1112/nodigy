<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\WizardSettingNym;

class WizardSettingNymResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'data_center_id' => $this->data_center_id,
            'server_id' => $this->server_id,
            'project_id' => $this->project_id,
            'wallet' => $this->wallet,
            'node_id' => $this->node_id,
            'data_center_type' => $this->data_center_type,
            'country' => $this->country,
            'city' => $this->city,
            'node_key' => $this->node_key,
            'signature_first_key' => $this->signature_first_key,
            'signature_second_key' => $this->signature_second_key,
            'sphinx_key' => $this->sphinx_key,
            'host_bind_address' => $this->host_bind_address,
            'version' => $this->version,
            'mix_port' => $this->mix_port,
            'verloc_port' => $this->verloc_port,
            'http_port' => $this->http_port,
            'installation_json' => $this->installation_json,
            'step_description' => $this->step_description,
            'installation_log' => $this->installation_log,
            'progress_status' => $this->progress_status,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
