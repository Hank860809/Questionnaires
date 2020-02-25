<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table      = 'utt_answers';
    protected $primaryKey = 'answer_id';

    protected $fillable = [
        'service_id', 'questionnaire_id', 'start_date', 'end_date','option_id','reply_option','reply_option_value',
    ];
}
