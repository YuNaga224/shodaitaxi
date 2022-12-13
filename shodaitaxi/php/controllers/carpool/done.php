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
    Auth::requireLogin();
    $user = UserModel::getSession();
    $carpool = CarpoolModel::getSession();
    
    if($user->user_num === 1) {
        CarpoolQuery::deleteRecord($carpool);
        ChatQuery::deleteRecord($carpool);
        $user->user_num = 0;
        UserQuery::clearUserNum($user);
    }else{
        UserQuery::clearUserNum($user);
        CarpoolQuery::clearUser($carpool,$user);
        $user->user_num = 0;
    }
    CarpoolModel::clearSession();
    $user->relate_carpool = "none";
    UserQuery::clearRelate($user);
    UserModel::setSession($user);
    \view\carpool\done\index();
}