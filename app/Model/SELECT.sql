SELECT `sr_id` as 'SR單號',`creation_date` as '發送日期',
case when (`service_id` = 1 AND `questionnaire_id` =1) then `reply_option` end '問題1_請問您這次是透過何種管道報修?(單選)'
,case when (`service_id` = 2 AND `questionnaire_id` =1) then `reply_option` end '問題2_您對此次「報修過程」的整體滿意度評價?(評比等級)'
,case when (`service_id` = 3 AND `questionnaire_id` =1) then `reply_option` end '問題3_請問您此次報修的問題是否已解決?(是非)'
,case when (`service_id` = 4 AND `questionnaire_id` =1) then `reply_option` end '問題4_請問您對此次工程師的技術能力是否滿意?(評比等級)'
,case when (`service_id` = 5 AND `questionnaire_id` =1) then `reply_option` end '問題5_請問您對此次工程師的服務態度是否滿意?(評比等級)'
,case when (`service_id` = 6 AND `questionnaire_id` =1) then `reply_option` end '問題6_請問您對此次到場服務的速度或安排是否滿意?(評比等級)'
,case when (`service_id` = 7 AND `questionnaire_id` =1) then `reply_option` end '問題7_請問您對此次服務的整體滿意度評價?(評比等級)'
,case when (`service_id` = 8 AND `questionnaire_id` =1) then `reply_option` end '問題8_請問您對敝公司所提供的售後服務是否有任何建議?(建議)' FROM `utt_answers`


select * from(
	SELECT `sr_id`, `service_id`,`reply_option`
	FROM utt_answers
)
Pivot(
	`reply_option`
    FOR `service_id` IN (1,2,3,4,5,6,7,8)
)

SELECT `questionnaire_id` as '序號',`sr_id` as 'SR單號',`creation_date` as '發送日期',
        MAX(CASE WHEN `service_id` = '1' THEN `reply_option` END) AS '問題1_請問您這次是透過何種管道報修?(單選)',
        MAX(CASE WHEN `service_id` = '2' THEN `reply_option_value` END) AS '問題2_您對此次「報修過程」的整體滿意度評價?(評比等級)',
        MAX(CASE WHEN `service_id` = '3' THEN `reply_option` END) AS '問題3_請問您此次報修的問題是否已解決?(是非)',
        MAX(CASE WHEN `service_id` = '4' THEN `reply_option_value` END) AS '問題4_請問您對此次工程師的技術能力是否滿意?(評比等級)',
        MAX(CASE WHEN `service_id` = '5' THEN `reply_option_value` END) AS '問題5_請問您對此次工程師的服務態度是否滿意?(評比等級)',
        MAX(CASE WHEN `service_id` = '6' THEN `reply_option_value` END) AS '問題6_請問您對此次到場服務的速度或安排是否滿意?(評比等級)',
        MAX(CASE WHEN `service_id` = '7' THEN `reply_option_value` END) AS '問題7_請問您對此次服務的整體滿意度評價?(評比等級)',
        MAX(CASE WHEN `service_id` = '8' THEN `reply_option` END) AS '問題8_請問您對敝公司所提供的售後服務是否有任何建議?(建議)'
        FROM utt_answers GROUP BY sr_id,`questionnaire_id`
