<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class BlockChain extends Model
{
    use SoftDeletes;

    const ACTIVE = 1;
    const DEACTIVE = 0;

    protected $table = 'chains';// block_chains to chains

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // chain_status
    public static $status = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    // chain_type
    public static $chainType = [
        1 => 'TESTNET',
        0 => 'MAINNET',
    ];

    public function getImageUrl()
    {
        $STATIC_IMAGE_SITE = env('STATIC_IMAGE_SITE',asset('/'));
        if($this->chain_logo){
            if($this->chain_logo) {
                return $STATIC_IMAGE_SITE."/chain_logo/".$this->chain_logo;
            }
        }
        return "";
    }

    public function Network()
    {
        return $this->belongsTo(Network::class,'network_id','id');
    }
}
