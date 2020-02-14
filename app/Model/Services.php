<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table      = 'utt_services';
    protected $primaryKey = 'service_id';

    public function GetServices($Question_id){
        $Services = Services::select()
                        ->join('utt_survey_to_service','utt_services.service_id','=','utt_survey_to_service.service_id')
                        ->join('utcss_survey_subject','utt_survey_to_service.survey_subject_id','=','utcss_survey_subject.survey_subject_id')
                        ->join('utt_question_to_survey','utcss_survey_subject.survey_subject_id','=','utt_question_to_survey.survey_subject_id')
                        ->join('utt_questionnaires','utt_questionnaires.questionnaire_id','=','utt_question_to_survey.questionnaire_id')
                        ->where('utt_questionnaires.questionnaire_id' , '=' ,"$Question_id")
                        ->get();
                        // dd($Services);
        return $Services;
    }
}
