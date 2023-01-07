<?php 
namespace controller\resetpassword;

use lib\Auth;
use model\UserModel;
use lib\Msg;
function get() {
    Auth::requireLogin();
    \view\resetpassword\index();

}

function post() {
    Auth::requireLogin();
    $user = UserModel::getSession();
    $current_pwd = get_param('current_pwd',"");
    $new_pwd = get_param('new_pwd',"");
    $onemore_pwd = get_param('onemore_pwd',"");
    if(Auth::resetPassword($user->id,$current_pwd,$new_pwd,$onemore_pwd)){
        Msg::push(Msg::INFO, "パスワードを更新しました！");
        

    }
    redirect('resetpassword');

}
