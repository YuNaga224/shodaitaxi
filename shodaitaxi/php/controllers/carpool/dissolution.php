<?php 
namespace controller\carpool\dissolution;

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
    if($user->id === $carpool->rep_id) {
        CarpoolQuery::deleteRecord($carpool);
    }
    
    CarpoolModel::clearSession();
    $user->relate_carpool = "none";
    $user->user_num = 0;
    UserQuery::clearRelate($user);
    UserQuery::clearUserNum($user);
    UserModel::setSession($user);
    redirect(GO_HOME);
}