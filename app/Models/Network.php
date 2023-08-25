<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Network extends Model
{
    use HasFactory, SoftDeletes;

    const ACTIVE = 1;
    const DEACTIVE = 0;

    protected $table = 'networks';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // network_status
    public static $status = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    protected $fillable = [
        'network_name',
        'network_sno',
        'network_logo',
        'network_status',
        'network_description',
        'created_by',
        'updated_by'
    ];

    public function getImageUrl()
    {
        $STATIC_IMAGE_SITE = env('STATIC_IMAGE_SITE',asset('/'));
        if($this->network_logo){
            if($this->network_logo) {
                return $STATIC_IMAGE_SITE."/network_logo/".$this->network_logo;
            }
        }
        return "";
    }

    public function supportedWallets()
    {
        return $this->hasMany(SupportedWallet::class);
    }
}
