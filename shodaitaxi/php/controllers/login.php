<?php 
namespace controller\login;

use db\CarpoolQuery;
use lib\Auth;
use model\UserModel;
use lib\Msg;
use model\CarpoolModel;

function get() {

    \view\login\index();
    
}

function post() {

    $id = get_param('id','');
    $pwd = get_param('pwd','');

    if(Auth::login($id,$pwd)) {
        $user = UserModel::getSession();
        Msg::push(Msg::INFO, "{$user->nickname}さん、ようこそ！");
        $carpool = CarpoolQuery::fetchByUserId($user);
        if(!empty($carpool)) {
            CarpoolModel::setSession($carpool);
        }
        redirect(GO_HOME);
    } else {
        redirect(GO_REFERER);
    }
    
}
?>