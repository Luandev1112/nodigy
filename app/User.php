<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use App\Models\Node;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    const ADMIN = 1;
    const USER = 2;

    public static $status = [
        1 => 'Active',
        0 => 'Inactive',
    ];
    public static $role = [
        1 => 'Super Admin',
        2 => 'Client',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_type', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getUserID()
    {
        return $this->id+1000000000;
    }

    public function nodes() {
        return $this->hasMany(Node::class, 'user_id');
    }
}