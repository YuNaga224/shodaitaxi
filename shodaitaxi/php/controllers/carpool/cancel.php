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
    Auth::requireLogin();
    $user = UserModel::getSession();
    $carpool = CarpoolModel::getSession();


    ChatQuery::infoLeave($carpool,$user);
    CarpoolQuery::clearUser($carpool,$user);
    UserQuery::clearUserNum($user);
    $user->user_num = 0;

    CarpoolModel::clearSession();
    $user->relate_carpool = "none";
    UserQuery::clearRelate($user);
    UserModel::setSession($user);
    redirect(GO_HOME);
}