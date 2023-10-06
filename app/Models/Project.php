<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use SoftDeletes;

    const ACTIVE = 1;
    const DEACTIVE = 0;

    protected $table= 'project';
    protected $fillable = [
        'project_name',
        'project_token',
        'project_sno',
        'chain_id',
        'network_id',
        'description',
        'supp_wallet_id',
        'project_website',
        'twitter_url',
        'explorer',
        'image',
        'network_type',
        'project_status',
        'created_by',
        'updated_by'
    ];

    // project_status
    public static $status = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    public function network()
    {
        return $this->belongsTo(Network::class, 'network_id');
    }

    public function chain()
    {
        return $this->belongsTo(Chain::class, 'chain_id');
    }

    public function getImageUrl()
    {
        $STATIC_IMAGE_SITE = env('STATIC_IMAGE_SITE',asset('/'));
        if($this->image){
            if($this->image) {
                return $STATIC_IMAGE_SITE."/project_image/".$this->image;
            }
        }
        return "";
    }

    public function wizardSetting()
    {
        return $this->hasMany(WizardSetting::class);
    }

    public  function nodes()
    {
        return $this->hasMany(Node::class, 'project_id');
    }
}
