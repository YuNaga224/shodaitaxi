function getAllData(){
  num = 1;
  $.ajax({
      // 通信先ファイル名
      url: "ajax-chat-log.php",
      // 通信が成功した時
  })
  .then(

      function(data) {
          // 取得したレコードをeachで順次取り出す
          $('#all_show_result').html('<div class="d-none"' + data[0]['body'] + "</div>");
          $.each(data, function(key, value){
              // #all_show_result内にappendで追記していく
              if(value.body != ""){
                if(value.nickname === '[参加お知らせ]'){
                  $('#all_show_result').append('<div class="">' + '<p class="w-80 bg-light text-black mb-3 p-2 mx-4 rounded">' + value.body + "</p>" + "</div>");
                  num += 1;
                }else if(value.nickname === '[辞退お知らせ]'){
                  $('#all_show_result').append('<div class="">' + '<p class="w-80 bg-light text-black mb-3 p-2 mx-4 rounded">' + value.body + "</p>" + "</div>");
                  num -= 1;
                }else{
                  $('#all_show_result').append('<div class="">' + value.nickname + '<p class="w-80 bg-primary text-white mb-3 p-2 mx-4 rounded">' + value.body + "</p>" + "</div>");
  
                }

              }
  
          });
          $('#member-infomation').html('現在の参加者数は' + num + '/4' + '人です');
      },
      function(){

      }
  );
}

$(document).ready(function() {
  getAllData();
  setInterval('getAllData()',1000);
});

$('#ajax_add').on('click',function(){
  // 確認メッセージを表示
  // OKならtrue,キャンセルならfalseが代入される
  $.ajax({
      // 送信方法
      type: "POST",
      // 送信先ファイル名
      url: "ajax-chat-add.php",
      // 受け取りデータの種類
      datatype: "json",
      // 送信データ
      data: {
          // #nameと#priceのvalueをセット
          "body" : $('#body').val()
      },
      // 通信が成功した時
      success: function(data) {
        $('#body').val("")
      },

      // 通信が失敗した時
      error: function(data) {
          console.log("通信失敗");
          console.log(data);
      }
  });

  return false;
});

