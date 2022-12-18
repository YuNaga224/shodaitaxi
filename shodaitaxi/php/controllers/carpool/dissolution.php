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
    Auth::requireLogin();
    $user = UserModel::getSession();
    $carpool = CarpoolModel::getSession();
    if($user->user_num === 1) {
        CarpoolQuery::deleteRecord($carpool);
        ChatQuery::deleteRecord($carpool);
        $user->user_num = 0;
        UserQuery::clearUserNum($user);
    }
    
    CarpoolModel::clearSession();
    $user->relate_carpool = "none";
    UserQuery::clearRelate($user);
    UserQuery::clearUserNum($user);
    UserModel::setSession($user);
    redirect(GO_HOME);
}