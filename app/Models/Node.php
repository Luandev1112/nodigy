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
        2 => 'Installation',
        3 => 'Installation Success'
    ];

    public static $installationStatus = [
        'server' => 'Choose Server',
        'wallet' => 'Wallet',
        'install' => 'Node Installing now',
        'signatture' => 'Waiting for signature',
        'fail' => 'Installation failed',
        'success' => 'Successfully installed',
        'stake' => 'Staking now'
    ];

    protected $fillable = [
        'user_id',
        'project_id',
        'server_id',
        'user_wallet_id',
        'node_name',
        'node_logo',
        'node_status',
        'installation_status',
        'node_wallet',
        'description',
        'node_wallet'
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

    public function wizard_setting_nym() 
    {
        return $this->hasMany(WizardSettingNym::class, 'node_id');
    }
}
