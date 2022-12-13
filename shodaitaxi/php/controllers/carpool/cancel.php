<?php 
namespace controller\carpool\cancel;

use db\CarpoolQuery;
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

    if($user->user_num === 1) {
        CarpoolQuery::deleteRecord($carpool);
        $user->user_num = 0;
        UserQuery::clearUserNum($user);

    }else{
        CarpoolQuery::clearUser($carpool,$user);
        UserQuery::clearUserNum($user);
        $user->user_num = 0;
    }
    CarpoolModel::clearSession();
    $user->relate_carpool = "none";
    UserQuery::clearRelate($user);
    UserModel::setSession($user);
    redirect(GO_HOME);
}