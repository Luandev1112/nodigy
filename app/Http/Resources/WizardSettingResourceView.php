<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\WizardSetting;

class WizardSettingResourceView extends JsonResource
{
    public function toArray($request)
    {
        $serverType = WizardSetting::$serverType;
        return [
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'id' => $this->id,
            'project_id' => $this->project_id,
            'difficulty' => $this->difficulty,
            'min_stake' => $this->min_stake,
            'token' => $this->token,
            'gas_fee_token' => $this->gas_fee_token,
            'chain_id' => $this->chain_id,
            'setup_fee' => ($this->setup_fee)? floatval($this->setup_fee):0,
            'staking_amount' => ($this->setup_fee)? floatval($this->setup_fee):0,
            'is_video_guide_link' => $this->is_video_guide_link,
            'video_guide_link' => $this->video_guide_link,
            'is_text_guide_link' => $this->is_text_guide_link,
            'text_guide_link' => $this->text_guide_link,
            'config_minimum_required' => [
                'server_config_type' => 1,
                'is_show' => ($this->min_req_vcpus > 0)? true :false,
                'min_req_vcpus' => $this->min_req_vcpus,
                'min_req_vcpus_type' => $this->min_req_vcpus_type,
                'min_req_vcpus_type_text' => (isset($serverType[$this->min_req_vcpus_type]))? $serverType[$this->min_req_vcpus_type]:"",
                'min_req_ram' => $this->min_req_ram,
                'min_req_ssd' => $this->min_req_ssd,
                'min_req_price' => ($this->min_req_price)? floatval($this->min_req_price):0,
            ],
            'config_recommended' => [
                'server_config_type' => 2,
                'is_show' => ($this->recom_vcpus > 0)? true :false,
                'recom_vcpus' => $this->recom_vcpus,
                'recom_vcpus_type' => $this->recom_vcpus_type,
                'recom_vcpus_type_text' => (isset($serverType[$this->recom_vcpus_type]))? $serverType[$this->recom_vcpus_type]:"",
                'recom_ram' => $this->recom_ram,
                'recom_ssd' => $this->recom_ssd,
                'recom_price' => ($this->recom_price)? floatval($this->recom_price):0,
            ],
            'config_max_performance' => [
                'server_config_type' => 3,
                'is_show' => ($this->max_perf_vcpus > 0)? true :false,
                'max_perf_vcpus' => $this->max_perf_vcpus,
                'max_perf_vcpus_type' => $this->max_perf_vcpus_type,
                'max_perf_vcpus_type_text' => (isset($serverType[$this->max_perf_vcpus_type]))? $serverType[$this->max_perf_vcpus_type]:"",
                'max_perf_ram' => $this->max_perf_ram,
                'max_perf_ssd' => $this->max_perf_ssd,
                'max_perf_price' => ($this->max_perf_price)? floatval($this->max_perf_price):0,
            ],
            'where_to_buy' => $this->where_to_buy,
        ];
    }
}
