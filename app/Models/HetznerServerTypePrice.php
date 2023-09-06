<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HetznerServerTypePrice extends Model
{
    use HasFactory;

    protected $table = 'hetzner_server_type_prices';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'parent_id',
        'location',
        'price_hourly_net',
        'price_hourly_gross',
        'price_monthly_net',
        'price_monthly_gross',
    ];

    public function serverType()
    {
        return $this->belongsTo(HetznerServerType::class);
    }
}
