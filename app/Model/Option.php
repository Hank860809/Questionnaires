<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table      = 'utt_option';
    protected $primaryKey = 'option_id';

    public function GetOption($Question_id){
        $Option = Option::select()
                        ->join('utt_topics_to_option','utt_option.option_id','=','utt_topics_to_option.option_id')
                        ->join('utt_topics','utt_topics_to_option.topic_id','=','utt_topics.topic_id')
                        ->join('utt_category_to_topic','utt_topics.topic_id','=','utt_category_to_topic.topic_id')
                        ->join('utt_category','utt_category_to_topic.category_id','=','utt_category.category_id')
                        ->join('utt_question_to_category','utt_category.category_id','=','utt_question_to_category.category_id')
                        ->join('utt_questionnaires','utt_questionnaires.questionnaire_id','=','utt_question_to_category.questionnaire_id')
                        ->orderBy('utt_topics_to_option.id', 'asc')
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
