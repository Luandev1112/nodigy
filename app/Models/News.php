<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use SoftDeletes;

    const ACTIVE = 1;
    const DEACTIVE = 0;

    protected $table = 'news';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // news_status
    public static $status = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    public function getImageUrl()
    {
        $STATIC_IMAGE_SITE = env('STATIC_IMAGE_SITE',asset('/'));
        if($this->image){
            if($this->image) {
                return $STATIC_IMAGE_SITE."/news_image/".$this->image;
            }
        }
        return "";
    }

    public function NewsCategory()
    {
        return $this->belongsTo(NewsCategory::class,'news_category_id','id');
    }
}
