<?php 
namespace controller\userdestroy;

use lib\Auth;
use model\UserModel;
use lib\Msg;
function get() {
    Auth::requireLogin();
    \view\userdestroy\index();
}

function post() {
    Auth::requireLogin();
    $user = UserModel::getSession();
    $pwd = get_param('pwd','');
    $onemore_pwd = get_param('onemore_pwd','');
    if(Auth::destroy($user->id,$pwd,$onemore_pwd)) {
        Msg::push(Msg::INFO,'アカウントを削除しました');
        redirect(GO_HOME);
    }else{
        redirect('userdestroy');
    }
}
?>