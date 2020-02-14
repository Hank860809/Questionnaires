<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Questionnaires;
use App\Model\Survey;
use App\Model\Services;
use App\Model\Option;
use App\Model\Answer;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // public function GetQuestion($Question_id){

    //     $Questionnaires = new Questionnaires;
    //     $Survey = new Survey;
    //     $Services = new Services;
    //     $Option = new Option;

    //     // $QuestionTitle 取出

    //     $QuestionTitle = $Questionnaires->GetQuestionTitle($Question_id);
    //     $QuestionDate = $Questionnaires->GetQuestionDate($Question_id);
    //     // dd($QuestionDate);

    //     $GetSurvey = $Survey->GetSurvey($Question_id);
    //     $SurveyData = $Survey->GetSurveyData($Question_id);

    //     $ServicesData = $Services->GetServices($Question_id);

    //     $OptionData = $Option->GetOption($Question_id);

    //     // dd($OptionData);
    //     // dd($QuestionSurveys[0]['survey_subject']);
    //     return view('index' , compact('QuestionDate','QuestionTitle','SurveyData','ServicesData','OptionData'));
    // }

    public function index($Question_id)
    {
        $Questionnaires = new Questionnaires;
        $Survey = new Survey;
        $Services = new Services;
        $Option = new Option;

        // $QuestionTitle 取出

        $QuestionTitle = $Questionnaires->GetQuestionTitle($Question_id);
        $QuestionDate = $Questionnaires->GetQuestionDate($Question_id);

        $GetSurvey = $Survey->GetSurvey($Question_id);
        $SurveyData = $Survey->GetSurveyData($Question_id);

        $ServicesData = $Services->GetServices($Question_id);

        $OptionData = $Option->GetOption($Question_id);

        // dd($OptionData);
        // dd($QuestionSurveys[0]['survey_subject']);
        return view('index' , compact('Question_id','QuestionDate','QuestionTitle','SurveyData','ServicesData','OptionData'));
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
        // dd($Ans);
        $Option = new Option;
        // $OptionName = $Option->GetOptionName($Ans[1]['option_id']);
        // dd($OptionName[0]);
        for($i=0;$i<$Count_Ans;$i++){
            $OptionName = $Option->GetOptionName($Ans[$i]['option_id']);
            $OptionValue = $Option->GetOptionValue($Ans[$i]['option_id']);
            // dd($Ans);
            if($Ans[$i]['option_id'] == '100'){
                $ans = Answer::create([
                    'service_id' => $Ans[$i]['service_id'],
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
                    'service_id' => $Ans[$i]['service_id'],
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
