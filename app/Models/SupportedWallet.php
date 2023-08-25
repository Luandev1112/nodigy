<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SupportedWallet extends Model
{
    use HasFactory, SoftDeletes;

    const ACTIVE = 1;
    const DEACTIVE = 0;

    protected $table= 'supported_wallets';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // supp_wallet_status
    public static $status = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    protected $fillable = [
        'network_id',
        'supp_wallet_name',
        'wallet_sno',
        'wallet_logo',
        'wallet_type',
        'supp_wallet_status',
        'created_by',
        'updated_by'
    ];

    public function network()
    {
        return $this->belongsTo(Network::class, 'network_id');
    }

    public function userWallets() {
        return $this->hasMany(UserWallet::class, 'wallet_id');
    }

    public function getImageUrl()
    {
        $STATIC_IMAGE_SITE = env('STATIC_IMAGE_SITE',asset('/'));
        if($this->wallet_logo){
            if($this->wallet_logo) {
                return $STATIC_IMAGE_SITE."/wallet_logo/".$this->wallet_logo;
            }
        }
        return "";
    }
}
