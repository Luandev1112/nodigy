<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HetznerServerType extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'hetzner_server_types';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function prices()
    {
        return $this->hasMany(HetznerServerTypePrice::class);
    }
}
