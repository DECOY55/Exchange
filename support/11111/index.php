<?
//echo '{"success":true,"data":{"ticket":{"id":11111,"user_id":370322,"category":"Deposit","subject":"\u043f\u043e\u043f\u043e\u043b\u043d\u0435\u043d\u0438\u0435?","status":1,"created_at":"2023-02-09 16:30:26","created_time":1675953026,"messages":[{"id":472920,"user_id":370322,"text":"\u041e\u0431\u044f\u0437\u0430\u0442\u0435\u043b\u044c\u043d\u043e \u043f\u043e\u043f\u043e\u043b\u043d\u044f\u0442\u044c?","is_read":1,"is_answer":false},{"id":472921,"user_id":184662,"text":"Please explain exactly what happened and a staff member will review this case. Due to increased traffic, response times can be longer than usual (up to 24 hours). A support agent will get back to you as soon as possible. Please only keep 1 ticket open at a time.","is_read":1,"is_answer":true}]},"title":"Ticket #11111"}}';

$json = '{"success":true,
   "data":{
      "ticket":{
         "id":11111,
         "user_id":370322,
         "category":"Deposit",
         "subject":"\u043f\u043e\u043f\u043e\u043b\u043d\u0435\u043d\u0438\u0435?",
         "status":1,
         "created_at":"2023-02-09 16:30:26",
         "created_time":1675953026,
         "messages":[
            {
               "id":472920,
               "user_id":370322,
               "text":"\u041e\u0431\u044f\u0437\u0430\u0442\u0435\u043b\u044c\u043d\u043e \u043f\u043e\u043f\u043e\u043b\u043d\u044f\u0442\u044c?",
               "is_read":1,
               "is_answer":false
            },
            {
               "id":472921,
               "user_id":184662,
               "text":"Please explain exactly what happened and a staff member will review this case. Due to increased traffic, response times can be longer than usual (up to 24 hours). A support agent will get back to you as soon as possible. Please only keep 1 ticket open at a time.",
               "is_read":1,
               "is_answer":true
            },
            {
               "id":472920,
               "user_id":370322,
               "text":"Ещё вопрос",
               "is_read":1,
               "is_answer":false
            },
         ]
      },
      "title":"Ticket #11111"
   }
}';

//echo json_encode($json);
?>