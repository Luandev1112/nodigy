<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'user_wallet';
    protected $fillable = [
        'wallet_id',
        'network_id',
        'user_id',
        'wallet_name',
        'address',
    ];

    public function supportedWallet()
    {
        return $this->belongsTo(SupportedWallet::class, 'wallet_id');
    }

    public function network()
    {
        return $this->belongsTo(Network::class, 'network_id');
    }

}
