<?php 
namespace controller\carpool\cancel;

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
    $user = UserModel::getSession();
    $carpool = CarpoolModel::getSession();

    //ユーザーがグループを抜けたと言う情報をchatテーブルに挿入
    ChatQuery::infoLeave($carpool,$user);
    //carpoolテーブルからnicknameを消去
    CarpoolQuery::clearUser($carpool,$user);
    //userテーブルのuser_numの値を0にリセット
    UserQuery::clearUserNum($user);
    $user->user_num = 0;

    //carpoolのセッション情報をクリア
    CarpoolModel::clearSession();
    //userテーブルとcarpool_idの紐づけを削除
    $user->relate_carpool = "none";
    UserQuery::clearRelate($user);
    //session情報を更新
    UserModel::setSession($user);
    redirect(GO_HOME);
}