<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\News;

class NewsResourceView extends JsonResource
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
            'image' => ($this->image)? $this->getImageUrl() :"",
            'description' => $this->description,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
