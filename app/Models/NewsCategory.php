<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class NewsCategory extends Model
{
    use SoftDeletes;

    const ACTIVE = 1;
    const DEACTIVE = 0;

    protected $table = 'news_category';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // category_status
    public static $status = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    public function getImageUrl()
    {
        $STATIC_IMAGE_SITE = env('STATIC_IMAGE_SITE',asset('/'));
        if($this->image){
            if($this->image) {
                return $STATIC_IMAGE_SITE."/news_category_image/".$this->image;
            }
        }
        return "";
    }
}
