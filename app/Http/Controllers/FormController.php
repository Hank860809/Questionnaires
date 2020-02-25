<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Questionnaires;
use App\Model\Category;
use App\Model\Topics;
use App\Model\Option;
use App\Model\Answer;
use App\Model\ServiceInfo;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($Sr_id,$Question_id)
    {
        $Questionnaires = new Questionnaires;
        $Category = new Category;
        $topics = new topics;
        $Option = new Option;
        $ServiceInfo = new ServiceInfo;

        $ServiceDate = $ServiceInfo->GetServiceDate($Sr_id);
        $ReplyStatus = $ServiceInfo->GetReplyStatus($Sr_id);
        $ReplyDate = $ServiceInfo->GetReplyDate($Sr_id);
        $ServiceInfo = $ServiceInfo->GetServiceInfo($Sr_id);

        $QuestionTitle = $Questionnaires->GetQuestionTitle($Question_id);
        $QuestionDate = $Questionnaires->GetQuestionDate($Question_id);

        if($QuestionTitle == null || $ReplyStatus == null){
            return view('error');
        }
        if($ReplyStatus == 'Y'){
            return view('thankyou',compact('ReplyStatus','ReplyDate'));
        }

        $GetCategory = $Category->GetCategory($Question_id);
        $CategoryData = $Category->GetCategoryData($Question_id);

        $topicsData = $topics->GetTopics($Question_id);

        $OptionData = $Option->GetOption($Question_id);


        return view('index' , compact('ServiceInfo','ServiceDate','Question_id','QuestionDate','QuestionTitle','CategoryData','topicsData','OptionData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = collect($request->all());
        $Ans = $request['Ans'];
        $Count_Ans = count($Ans);
        $Option = new Option;
        // $OptionName = $Option->GetOptionName($Ans[1]['option_id']);
        // dd($request);
        for($i=0;$i<$Count_Ans;$i++){

            $OptionName = $Option->GetOptionName($Ans[$i]['option_id']);
            $OptionValue = $Option->GetOptionValue($Ans[$i]['option_id']);
            // $Date = new DateTime();
            // $Date= $Date->format('Y-m-d');

            if($Ans[$i]['option_id'] == '100'){
                $ans = Answer::create([
                    'topic_id' => $Ans[$i]['topic_id'],
                    'questionnaire_id' => $Ans[$i]['QuestionID'],
                    'start_date' => $Ans[$i]['start_date'],
                    'end_date' => $Ans[$i]['end_date'],
                    'option_id' => $Ans[$i]['option_id'],
                    'reply_option' => $Ans[$i]['reply_option'],
                    'reply_option_value' => $OptionValue[0],
                ]);
            }
            else{
                $ans = Answer::create([
                    'topic_id' => $Ans[$i]['topic_id'],
                    'questionnaire_id' => $Ans[$i]['QuestionID'],
                    'start_date' => $Ans[$i]['start_date'],
                    'end_date' => $Ans[$i]['end_date'],
                    'option_id' => $Ans[$i]['option_id'],
                    'reply_option' => $OptionName[0],
                    'reply_option_value' => $OptionValue[0],
                ]);
            }

        }
        return redirect()->route('thankyou');
        // dd($ans);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
