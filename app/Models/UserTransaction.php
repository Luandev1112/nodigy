<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'user_transactions';
    protected $fillable = [
        'project_id',
        'server_id',
        'date',
        'user_id',
        'amount',
        'txn_id',
        'transaction_type',
        'purpose',
        'status'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function server()
    {
        return $this->belongsTo(Server::class, 'server_id');
    }


}
