<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nodes';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // node_status
    public static $nodeStatus = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    public static $nodeType = [
        'test' => 'Test',
        'main' => 'Main',
    ];

    protected $fillable = [
        'user_id',
        'project_id',
        'server_id',
        'user_wallet_id',
        'node_name',
        'node_logo',
        'node_type',
        'min_stake',
        'min_price',
        'setup_fee',
        'description',
        'node_status'
    ];

    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function UserWallet()
    {
        return $this->belongsTo(UserWallet::class,'user_wallet_id','id');
    }

    public function Project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function Server()
    {
        return $this->belongsTo(Server::class,'server_id','id');
    }

    public function getImageUrl()
    {
        if($this->node_logo){
            if(Storage::disk('local')->exists("public/node_logo/" . $this->node_logo)) {
                return asset('storage/node_logo')."/".$this->node_logo;
            }
        }
        return "";
    }
}
