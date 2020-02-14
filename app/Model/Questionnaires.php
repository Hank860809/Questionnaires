<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Questionnaires extends Model
{
    protected $table      = 'utt_questionnaires';
    protected $primaryKey = 'questionnaire_id';

    public function GetQuestion($Question_id){

        $Question = Questionnaires::select()
            ->where('questionnaire_id' , '=' ,"$Question_id")
            ->get();

        // $QuestionTitle = array_get($form->GetQuestionTitle($Question_id),"0.questionnaire_name");
        return $Question;
    }

    public function GetQuestionTitle($Question_id){

        $QuestionData = $this->GetQuestion($Question_id);
        $QuestionTitle = array_get($QuestionData,"0.questionnaire_name");

        return $QuestionTitle;
    }

    public function GetQuestionID($Question_id){

        $QuestionData = $this->GetQuestion($Question_id);
        $QuestionID = array_get($QuestionData,"0.questionnaire_id");

        return $QuestionID;
    }

    public function GetQuestionDate($Question_id){

        $QuestionData = $this->GetQuestion($Question_id);
        $QuestionDate = array_get($QuestionData,"0.end_date");
        $QuestionDate = strtotime($QuestionDate);
        $QuestionDate = date('Y/m/d',$QuestionDate);

        // dd($QuestionDate);

        return $QuestionDate;
    }
}
