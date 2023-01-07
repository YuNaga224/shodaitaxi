function getAllData(){
  // グループ内のユーザー数をカウントする変数
  user_num = 1;
  $.ajax({
      // 通信先ファイル名
      url: "ajax-chat-log.php",
    
  })
  .then(

      function(data) {
          // 取得したレコードをeachで順次取り出す
          $('#all_show_result').html('<div class="d-none"' + data[0]['body'] + "</div>");
          $.each(data, function(key, value){
              //メッセージが空じゃないときにログに追加する
              if(value.body != ""){
                //新しくメンバーが参加したとき
                if(value.nickname === '[参加お知らせ]'){
                  $('#all_show_result').append('<div class="">' + '<p class="text-center w-80 text-white mb-3 p-2 text-info mx-4 rounded">' + value.body + "</p>" + "</div>");
                  user_num += 1;
                  //メンバーがグループを抜けたとき
                }else if(value.nickname === '[辞退お知らせ]'){
                  $('#all_show_result').append('<div class="">' + '<p class="text-center w-80 text-white mb-3 text-danger p-2 mx-4 rounded">' + value.body + "</p>" + "</div>");
                  user_num -= 1;
                }else if(value.nickname === '[作成お知らせ]'){
                  //グループ作成時
                  $('#all_show_result').append('<div class="">' + '<p class="text-center w-80 text-white mb-3 text-info p-2 mx-4 rounded">' + value.body + "</p>" + "</div>");
                  //メッセージの送信主がcurrentUserのとき
                }else if(value.current_user === value.user_id){

                  $('#all_show_result').append('<div class="text-right">' + value.nickname + '<p class="text-left ml-auto w-50 text-white mb-3 p-2 mx-4 mymessage pl-3">' + value.body + "</p>" + "</div>");
                  //別のユーザーのとき
                }else {
                  $('#all_show_result').append('<div class="">' + value.nickname + '<p class="bg-white w-50 text-black mb-3 p-2 mx-4 othermessage pl-3">' + value.body + "</p>" + "</div>");
                }

              }
  
          });
          //グループ内のユーザー数を表示
          $('#member-infomation').html('現在の参加者数は' + user_num + '/4' + '人です');
      },
      function(){

      }
  );
}

//一秒ごとにロード
$(document).ready(function() {
  getAllData();
  setInterval('getAllData()',1000);
});

// チャットメッセージを送信
$('#ajax_add').on('click',function(){
  $.ajax({
      
      type: "POST",
      
      url: "ajax-chat-add.php",
      
      datatype: "json",
      
      data: {
          
          "body" : $('#body').val()
      },
      
      success: function(data) {
        $('#body').val("")
      },

      
      error: function(data) {
          console.log("通信失敗");
          console.log(data);
      }
  });

  return false;
});

