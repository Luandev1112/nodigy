<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataCenter extends Model
{
    use SoftDeletes;

    protected $table = 'data_centers';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
