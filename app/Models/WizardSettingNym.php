<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class WizardSettingNym extends Model
{
    use SoftDeletes;

    protected $table = 'wizard_setting_nym';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'user_id',
        'project_id',
        'wallet',
        'data_center_id',
        'server_id',
        'node_id',
        'data_center_type',
        'country',
        'city',
        'node_key',
        'signature_first_key',
        'signature_second_key',
        'sphinx_key',
        'host_bind_address',
        'version',
        'mix_port',
        'verloc_port',
        'http_port',
        'installation_json',
        'step_description',
        'installation_log',
        'progress_status',
    ];
}
