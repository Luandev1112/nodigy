<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\NewsCategory;

class NewsCategoryResource extends JsonResource
{    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_name' => $this->category_name,
        ];
    }
}
