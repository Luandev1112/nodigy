<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\News;

class NewsResource extends JsonResource
{    
    public function toArray($request)
    {        
        return [
            'id' => $this->id,
            'news_category_id' => $this->news_category_id,
            'category_name' => $this->category_name,
            'title' => $this->title,
            'tags' => $this->tags,
            'share_twitter' => $this->share_twitter,
            'share_telegram' => $this->share_telegram,
            'share_facebook' => $this->share_facebook,
            //'description' => $this->description,
            'image' => ($this->image)? $this->getImageUrl() :"",
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
