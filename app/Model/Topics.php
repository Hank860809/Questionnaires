<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    protected $table      = 'utt_topics';
    protected $primaryKey = 'topic_id';

    public function GetTopics($Question_id){
        $topics = topics::select()
                        ->join('utt_category_to_topic','utt_topics.topic_id','=','utt_category_to_topic.topic_id')
                        ->join('utt_category','utt_category_to_topic.category_id','=','utt_category.category_id')
                        ->join('utt_question_to_category','utt_category.category_id','=','utt_question_to_category.category_id')
                        ->join('utt_questionnaires','utt_question_to_category.questionnaire_id','=','utt_questionnaires.questionnaire_id')
                        ->where('utt_questionnaires.questionnaire_id' , '=' ,"$Question_id")
                        ->orderBy('utt_category_to_topic.sequence', 'asc')
                        ->get();
                        // dd($topics);
        return $topics;
    }
}
