@extends('welcome')
@section('content')

    <div class="container">
        <div class="alert alert-dark text-center justify-content-center" role="alert">
            ----------{{$QuestionTitle}}----------
        </div>
        <div class="p-3 mb-2 text-dark" style="background-color:#e6e5cc">
            發送編號：　　　　　　維修單號：<br>
            品號：<br>
            序號：<br>
            服務型態：　　　　　　案件型態：<br>
            問題描述：<br>
            到場日期：
        </div>
    <form name="question" method="POST" action="{{route('form.store')}}">
        @csrf
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">題號</th>
                    <th scope="col">項目</th>
                    <th scope="col">評分</th>
                </tr>
            </thead>
            <tbody>
                {{-- $j為Surevy的array長度 --}}
                @for($i=0;$i<count($SurveyData);$i++)
                <tr>
                    <th colspan="3">{{$SurveyData[$i]['survey_subject']}}</th>
                </tr>
                {{-- $j為Services的array長度 --}}
                @for($j=0;$j<count($ServicesData);$j++)
                <tr>
                    {{-- {{dd($OptionData)}} --}}
                    @if($ServicesData[$j]['survey_subject_id'] == $SurveyData[$i]['SurveyID'])
                    <th scope="row">第{{$j+1}}題</th>
                    <td>{{$ServicesData[$j]['service_name']}}</td>
                    <td>
                        <div class="form-check form-check-inline">
                            {{-- $z為Aption的array長度 --}}
                            {{-- {{dd($ServicesData)}} --}}
                            @for($z=0;$z<count($OptionData);$z++)
                                @if($OptionData[$z]['service_id'] == $ServicesData[$j]['service_id'])
                                    @if($OptionData[$z]['option_type'] == 'textarea')
                                        <textarea name="Ans[{{$j}}][reply_option]" rows="4" cols="50"></textarea>
                                        <input type="hidden" name="Ans[{{$j}}][service_id]" value="{{$ServicesData[$j]['service_id']}}">
                                        <input type="hidden" name="Ans[{{$j}}][option_id]" value="{{$OptionData[$z]['option_id']}}">
                                        <input type="hidden" name="Ans[{{$j}}][QuestionID]" value="{{$Question_id}}">
                                        <input type="hidden" name="Ans[{{$j}}][start_date]" value="{{date('Y/m/d',strtotime('-7 day', strtotime($QuestionDate)))}}">
                                        <input type="hidden" name="Ans[{{$j}}][end_date]" value="{{$QuestionDate}}">
                                        {{-- <input type="hidden" name="Ans[{{$j}}][start_date]" value="{{$QuestionDate+7}}"> --}}
                                    @else
                                        <input class="form-check-input" type="{{$OptionData[$z]['option_type']}}" name="Ans[{{$j}}][option_id]" id="ServiceID[{{$ServicesData[$j]['service_id']}}]opt[{{$OptionData[$z]['option_id']}}]" value="{{$OptionData[$z]['option_id']}}">
                                        <label class="form-check-label" for="ServiceID[{{$ServicesData[$j]['service_id']}}]opt[{{$OptionData[$z]['option_id']}}]">{{$OptionData[$z]['option_name']}} &ensp;&ensp; </label>
                                        <input type="hidden" name="Ans[{{$j}}][service_id]" value="{{$ServicesData[$j]['service_id']}}">
                                        <input type="hidden" name="Ans[{{$j}}][QuestionID]" value="{{$Question_id}}">
                                        <input type="hidden" name="Ans[{{$j}}][start_date]" value="{{date('Y/m/d',strtotime('-7 day', strtotime($QuestionDate)))}}">
                                        <input type="hidden" name="Ans[{{$j}}][end_date]" value="{{$QuestionDate}}">
                                        {{-- <input type="hidden" name="Ans[{{$j}}][reply_option]" value="{{$OptionData[$z]['option_name']}}"> --}}
                                    @endif
                                @endif
                            @endfor
                        </div>
                    </td>
                    @endif
                    @endfor
                </tr>
                @endfor
            </tbody>
        </table>
        <div class="text-center my-5">
            <button type="button" class="btn btn-primary"  onClick="check()">填完送出</button><br>
            <label class="text-muted">請選擇評分以進行提交。</label><br>
            <p class="text-muted">
                <br>
                有效日期：{{$QuestionDate}} （預設為發出日期往後推延一週）
            </p>
            <input type="checkbox" name="notification" id="notification" value="Y">
            <b><label class="form-check-label" for="notification">不希望再接收到精聯-滿意度問卷調查通知</label></b>
        </div>
    </form>
        <div class="text-center my-5 alert-dark alert">
            精聯電子 維修服務 0800-033-388
        </div>
    </div>

        {{-- 判斷使用者是否所有選項都有填寫 --}}

    <script type="text/javascript">
        //  此check()函式在最後的「填完送出」案鈕會用到
        function check(){
            // ServicesLenght為題目的總數
            const ServicesLenght = <?php echo count($ServicesData);?>;
            // opt用來記錄按鈕被選擇的次數
            var opt = 0;
            for(j=0;j<ServicesLenght;j++){
                const services = document.getElementsByName('Ans['+j+'][option_id]')
                // services為該題radio為array
                const OptionLenght = services.length;
                // OptionLenght為該題目有幾個選項
                for(i=0;i<OptionLenght;i++){
                    // 用來檢查每一個選項是否有被選擇
                    if(services[i].checked){
                        //如果該題radio選項有被選擇
                        opt += 1;
                    }
                }
            }
            if(opt+1<ServicesLenght){
                alert('還有'+(ServicesLenght-(opt+1))+'題尚未填寫');
            }
            else{
                document.question.submit();
            }
        }
    </script>

@endsection
