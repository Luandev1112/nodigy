<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'servers';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
