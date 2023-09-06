<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class WizardSetting extends Model
{
    use SoftDeletes;

    const ACTIVE = 1;
    const DEACTIVE = 0;

    protected $table = 'wizard_settings';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // min_req_vcpus_type, recom_vcpus_type, max_perf_vcpus_type
    public static $serverType = [
        1 => '2 core Intel',
        2 => '4 core Intel',
        3 => '8 core Intel',
        4 => '16 core Intel',
        5 => '2 core AMD',
        6 => '4 core AMD',
        7 => '8 core AMD',
        8 => '16 core AMD',
    ];
    public static $serverConfigType = [
        1 => 'Minimum required',
        2 => 'Recommended',
        3 => 'Max performance',
    ];

    public function WizardSettingStep()
    {
        return $this->hasMany(WizardSettingStep::class,'wizard_setting_id');
    }

    public function DataCenter()
    {
        return $this->belongsTo(DataCenter::class,'datacenter_server_id','server_id')->orderBy('id', 'desc');
    }
}
