<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WizardSettingStep extends Model
{
    protected $table = 'wizard_setting_steps';

    protected $dates = ['created_at', 'updated_at'];

    public function getImageUrl()
    {
        $STATIC_IMAGE_SITE = env('STATIC_IMAGE_SITE',asset('/'));
        if($this->field_type_logo){
            if($this->field_type_logo) {
                return $STATIC_IMAGE_SITE."/wizard-setting-step/".$this->field_type_logo;
            }
        }
        return "";
    }
}
