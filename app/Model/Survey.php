<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table      = 'utcss_survey_subject';
    protected $primaryKey = 'survey_subject_id';

    public function GetSurvey($Question_id){
        $Survey = Survey::select()
                        ->join('utt_question_to_survey','utcss_survey_subject.survey_subject_id','=','utt_question_to_survey.survey_subject_id')
                        ->join('utt_questionnaires','utt_questionnaires.questionnaire_id','=','utt_question_to_survey.questionnaire_id')
                        ->where('utt_questionnaires.questionnaire_id' , '=' ,"$Question_id")
                        ->get();
        return $Survey;
    }

    public function GetSurveyData($Question_id){

        $Survey = $this->GetSurvey($Question_id);
        $CountSurveyData = count($Survey);
        for($i=0;$i<$CountSurveyData;$i++){
            $SurveyData[$i]['SurveyID'] = array_get($Survey,"$i.survey_subject_id");
            $SurveyData[$i]['survey_subject'] = array_get($Survey,"$i.survey_subject");
        }
        // dd($SurveyData);
        return $SurveyData;
    }
}
