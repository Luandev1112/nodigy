<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use SoftDeletes;
            
    protected $table = 'settings';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];    
}
