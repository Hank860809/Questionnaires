<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table      = 'utt_option';
    protected $primaryKey = 'option_id';

    public function GetOption($Question_id){
        $Option = Option::select()
                        ->join('utt_services_to_option','utt_option.option_id','=','utt_services_to_option.option_id')
                        ->join('utt_services','utt_services_to_option.service_id','=','utt_services.service_id')
                        ->join('utt_survey_to_service','utt_services.service_id','=','utt_survey_to_service.service_id')
                        ->join('utcss_survey_subject','utt_survey_to_service.survey_subject_id','=','utcss_survey_subject.survey_subject_id')
                        ->join('utt_question_to_survey','utcss_survey_subject.survey_subject_id','=','utt_question_to_survey.survey_subject_id')
                        ->join('utt_questionnaires','utt_questionnaires.questionnaire_id','=','utt_question_to_survey.questionnaire_id')
                        ->where('utt_questionnaires.questionnaire_id' , '=' ,"$Question_id")
                        ->get();
        return $Option;
    }

    public function GetOptionName($option_id){
        $Option = Option::select('option_name')
                        ->where('option_id' , '=' ,"$option_id")
                        ->get();
        $OptionName = collect($Option[0]->option_name);

        return $OptionName;
    }

    public function GetOptionValue($option_id){
        $Option = Option::select('option_value')
                        ->where('option_id' , '=' ,"$option_id")
                        ->get();
        $OptionValue = collect($Option[0]->option_value);
        // dd($OptionValue);

        return $OptionValue;
    }
}
