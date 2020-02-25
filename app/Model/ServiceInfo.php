<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceInfo extends Model
{
    protected $table      = 'UTT_SURVEY_INFO';
    protected $primaryKey = 'survey_id';

    public function GetServiceInfo($Sr_id){
        $ServiceInfo = ServiceInfo::select()
                                ->where('sr_id','=',$Sr_id)
                                ->get();

        return $ServiceInfo;
    }

    public function GetServiceDate($Sr_id){
        $ServiceInfo = $this->GetServiceInfo($Sr_id);

        $ServiceDate = array_get($ServiceInfo,"0.service_date");
        $ServiceDate = strtotime($ServiceDate);
        $ServiceDate = date('Y/m/d',$ServiceDate);
        // dd($ServiceDate);
        return $ServiceDate;
    }

    public function GetReplyStatus($Sr_id){
        $ServiceInfo = $this->GetServiceInfo($Sr_id);
        $reply_status = array_get($ServiceInfo,"0.reply_status");

        // dd($reply_status);
        return $reply_status;
    }

    public function GetReplyDate($Sr_id){
        $ServiceInfo = $this->GetServiceInfo($Sr_id);

        $ReplyDate = array_get($ServiceInfo,"0.send_date");
        $ReplyDate = strtotime($ReplyDate);
        $ReplyDate = date('Y/m/d',$ReplyDate);
        // dd($ReplyDate);
        return $ReplyDate;
    }
}
