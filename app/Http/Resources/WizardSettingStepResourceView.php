<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\WizardSetting;

class WizardSettingStepResourceView extends JsonResource
{
    public function toArray($request)
    {
        $allWizardSettingStep = $this->wizardSettingStep;
        if(!empty($allWizardSettingStep))
        {
            $tmp=[];
            $tmp['step_2_name'] = $this->step_2_name;
            $tmp['step_2_description'] = $this->step_2_description;
            $tmp['step_2_video_link'] = $this->step_2_video_link;
            $tmp['step_3_name'] = $this->step_3_name;

            $tmp_field_name=[];
            $tmp_field_type=[];
            $tmp_field_type_option=[];
            $tmp_field_type_logo=[];
            $tmp_field_type_logo_full_path=[];
            if(!empty($allWizardSettingStep) && count($allWizardSettingStep)){
                foreach ($allWizardSettingStep as $key => $row)
                {
                    $step_group = $row->step_group;
                    if(!isset($tmp_field_name[$step_group])){
                        $tmp_field_name[$step_group] = $row->field_name;
                    }
                    if(!isset($tmp_field_type[$step_group])){
                        $tmp_field_type[$step_group] = $row->field_type;
                    }

                    $tmp_field_type_option[$step_group][] = $row->field_type_option;
                    $tmp_field_type_logo[$step_group][] = $row->field_type_logo ? $row->field_type_logo :"";
                    $tmp_field_type_logo_full_path[$step_group][] = $row->field_type_logo ? $row->getImageUrl() :"";
                }
                $step_group=[];
                for ($i = 0; $i < 2; $i++){
                    $field_name = (isset($tmp_field_name[$i]))? $tmp_field_name[$i]:"";
                    $field_type = (isset($tmp_field_type[$i]))? $tmp_field_type[$i]:"";
                    $field_type_option = (isset($tmp_field_type_option[$i]) && !empty($tmp_field_type_option[$i]))? $tmp_field_type_option[$i]:[];
                    $field_type_logo = (isset($tmp_field_type_logo[$i]) && !empty($tmp_field_type_logo[$i]))? $tmp_field_type_logo[$i]:[];
                    $field_type_logo_full_path = (isset($tmp_field_type_logo_full_path[$i]) && !empty($tmp_field_type_logo_full_path[$i]))? $tmp_field_type_logo_full_path[$i]:[];
                    $step_group[$i]['field_name']=$field_name;
                    $step_group[$i]['field_type']=$field_type;
                    $step_group[$i]['field_type_option']=[];
                    if($field_type=="select"){
                        if(count($field_type_option) && !empty($field_type_option)){
                            foreach ($field_type_option as $optionkey => $option_row){
                                $logo_name = (isset($field_type_logo[$optionkey]) && !empty($field_type_logo[$optionkey]))? $field_type_logo[$optionkey]:"";
                                $logo = (isset($field_type_logo_full_path[$optionkey]) && !empty($field_type_logo_full_path[$optionkey]))? $field_type_logo_full_path[$optionkey]:"";
                                $step_group[$i]['field_type_option'][]=['option'=>$option_row,'logo'=>$logo];
                            }
                        }
                    }
                }
                $tmp['step_3_group']=$step_group;
            }

            return $tmp;
        }
        return [];
    }
}
