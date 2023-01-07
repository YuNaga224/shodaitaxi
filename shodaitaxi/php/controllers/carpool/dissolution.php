<?php 
namespace controller\carpool\dissolution;

use db\CarpoolQuery;
use db\ChatQuery;
use db\UserQuery;
use lib\Auth;
use model\CarpoolModel;
use model\UserModel;

function get() {

}

function post() {
    //ログインを要求
    Auth::requireLogin();
    //セッションから情報を取得
    $user = UserModel::getSession();
    $carpool = CarpoolModel::getSession();
    

    if($user->user_num === 1) {
        CarpoolQuery::deleteRecord($carpool);
        ChatQuery::deleteRecord($carpool);
        $user->user_num = 0;
        UserQuery::clearUserNum($user);
    }
    
    //セッション情報を更新
    CarpoolModel::clearSession();
    $user->relate_carpool = "none";
    //userとcarpoolの紐づけを削除
    UserQuery::clearRelate($user);
    UserQuery::clearUserNum($user);
    UserModel::setSession($user);
    redirect(GO_HOME);
}