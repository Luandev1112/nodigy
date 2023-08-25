<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NymNodeLog extends Model
{
    use SoftDeletes;

    protected $table = 'nym_node_log';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['node_id', 'response_json'];

    // node_status
    public static $nodeStatus = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    public static $nodeType = [
        'test' => 'Test',
        'main' => 'Main',
    ];

    public function Node()
    {
        return $this->belongsTo(Node::class,'node_id','id');
    }
}
