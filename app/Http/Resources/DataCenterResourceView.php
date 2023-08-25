<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class DataCenterResourceView extends JsonResource
{
    public function toArray($request)
    {
        return [
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'sync_date' => $this->sync_date,
            'id' => $this->id,
            'server_id' => $this->server_id,
            'server_name' => $this->server_name,
            'datacenter_id' => $this->datacenter_id,
            'datacenter_name' => $this->datacenter_name,
            'cpu' => $this->cpu,
            'ram' => $this->ram,
            'ssd' => $this->ssd,
            'os' => $this->os,
            'location_name' => $this->location_name,
            'city' => $this->city,
            'country' => $this->country,
            'price_hourly_net' => $this->price_hourly_net,
            'price_hourly_gross' => $this->price_hourly_gross,
            'price_monthly_net' => $this->price_monthly_net,
            'price_monthly_gross' => $this->price_monthly_gross,
            'api_log' => ($this->api_log)? json_decode($this->api_log,true):[],
        ];
    }
}
