<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'subscription';

    protected $dates = ['email_verified_at','created_at', 'updated_at', 'deleted_at'];

    const VERIFIED = 1;
    const NOTVERIFIED = 0;

    const ISEMAIL = 0;
    const ISNEWS = 1;

    public static $subscription_status = [
        1 => 'Verified',
        0 => 'Not-Verified',
    ];

    public static $subscribe_type = [
        0 => 'Subscribe-Email',
        1 => 'Subscribe-News',
    ];
}
