<?php

namespace App\Exports;

use App\Model\Answer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;      //匯出集合
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;         //匯出Query
use Maatwebsite\Excel\Concerns\WithHeadings;         //設定欄位名稱
use Maatwebsite\Excel\Concerns\WithMapping;         //設定匯出數據
// use Maatwebsite\Excel\Concerns\WithEvents;     // 自動註冊事件監聽器
// use Maatwebsite\Excel\Concerns\WithStrictNullComparison;    // 匯出 0 原樣顯示，不為 null
// use Maatwebsite\Excel\Concerns\WithTitle;    // 設定工作䈬名稱
// use Maatwebsite\Excel\Events\AfterSheet;    // 在工作表流程結束時會引發事件

class QuestionnaireExport implements FromArray,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $Answer = new Answer;
        $query = DB::select("SELECT questionnaire_id as '序號',sr_id as 'SR單號',creation_date as '發送日期',
        MAX(CASE WHEN service_id = '1' THEN reply_option END) AS '問題1_請問您這次是透過何種管道報修?(單選)',
        MAX(CASE WHEN service_id = '2' THEN reply_option_value END) AS '問題2_您對此次「報修過程」的整體滿意度評價?(評比等級)',
        MAX(CASE WHEN service_id = '3' THEN reply_option END) AS '問題3_請問您此次報修的問題是否已解決?(是非)',
        MAX(CASE WHEN service_id = '4' THEN reply_option_value END) AS '問題4_請問您對此次工程師的技術能力是否滿意?(評比等級)',
        MAX(CASE WHEN service_id = '5' THEN reply_option_value END) AS '問題5_請問您對此次工程師的服務態度是否滿意?(評比等級)',
        MAX(CASE WHEN service_id = '6' THEN reply_option_value END) AS '問題6_請問您對此次到場服務的速度或安排是否滿意?(評比等級)',
        MAX(CASE WHEN service_id = '7' THEN reply_option_value END) AS '問題7_請問您對此次服務的整體滿意度評價?(評比等級)',
        MAX(CASE WHEN service_id = '8' THEN reply_option END) AS '問題8_請問您對敝公司所提供的售後服務是否有任何建議?(建議)'
        FROM utcss_answers GROUP BY sr_id,questionnaire_id,creation_date");
        // dd($query);
        // return $Answer->where('sr_id','=','1');
        return $query;
    }

    // public function map($Answer): array
    // {
    //     return [
    //             $Answer->creation_date,
    //             $Answer->sr_id,
    //             $Answer->service_id,
    //             $Answer->reply_option,
    //     ];
    // }

    public function headings(): array{
        return [
            '序號',
            'SR單號',
            '發送日期',
            '問題1_請問您這次是透過何種管道報修?(單選)',
            '問題2_您對此次「報修過程」的整體滿意度評價?(評比等級)',
            '問題3_請問您此次報修的問題是否已解決?(是非)',
            '問題4_請問您對此次工程師的技術能力是否滿意?(評比等級)',
            '問題5_請問您對此次工程師的服務態度是否滿意?(評比等級)',
            '問題6_請問您對此次到場服務的速度或安排是否滿意?(評比等級)',
            '問題7_請問您對此次服務的整體滿意度評價?(評比等級)',
            '問題8_請問您對敝公司所提供的售後服務是否有任何建議?(建議)'
        ];
    }
}
