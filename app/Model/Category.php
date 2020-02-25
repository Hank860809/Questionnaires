<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table      = 'utt_category';
    protected $primaryKey = 'category_id';

    public function GetCategory($Question_id){
        $Category = Category::select()
                        ->join('utt_question_to_category','utt_category.category_id','=','utt_question_to_category.category_id')
                        ->join('utt_questionnaires','utt_questionnaires.questionnaire_id','=','utt_question_to_category.questionnaire_id')
                        ->where('utt_questionnaires.questionnaire_id' , '=' ,"$Question_id")
                        ->get();
        return $Category;
    }

    public function GetCategoryData($Question_id){

        $Category = $this->GetCategory($Question_id);
        $CountCategoryData = count($Category);
        for($i=0;$i<$CountCategoryData;$i++){
            $CategoryData[$i]['CategoryID'] = array_get($Category,"$i.category_id");
            $CategoryData[$i]['category'] = array_get($Category,"$i.category");
        }
        return $CategoryData;
    }
}
