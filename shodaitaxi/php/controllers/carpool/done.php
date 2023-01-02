<?php 
namespace controller\carpool\done;

use db\CarpoolQuery;
use db\UserQuery;
use lib\Auth;
use model\CarpoolModel;
use model\UserModel;
use db\ChatQuery;
function get() {

}

function post() {
    //ログインを要求
    Auth::requireLogin();
    //セッションから情報を取得
    $user = UserModel::getSession();
    $carpool = CarpoolModel::getSession();
    
    //グループのホストかどうかで処理を分ける
    if($user->user_num === 1) {
        //carpoolとchatテーブルからレコードを削除
        CarpoolQuery::deleteRecord($carpool);
        ChatQuery::deleteRecord($carpool);
        //user_numを0に更新
        $user->user_num = 0;
        UserQuery::clearUserNum($user);
    }else{
        CarpoolQuery::clearUser($carpool,$user);
        UserQuery::clearUserNum($user);
        $user->user_num = 0;
        
    }
    //セッション情報を削除
    CarpoolModel::clearSession();
    //userとcarpoolの紐づけを削除
    $user->relate_carpool = "none";
    UserQuery::clearRelate($user);
    //セッション情報更新
    UserModel::setSession($user);
    \view\carpool\done\index();
}