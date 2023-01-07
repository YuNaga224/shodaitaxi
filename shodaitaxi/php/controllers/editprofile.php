<?php 
namespace controller\editprofile;
use db\UserQuery;
use lib\Auth;
use model\UserModel;
use lib\Msg;
function get() {
    Auth::requireLogin();
    \view\editprofile\index();
}

function post() {
    $user = UserModel::getSession();
    $user->nickname = get_param('nickname',$user->nickname);
    $user->grade = get_param('grade','未選択');
    UserQuery::updateProfile($user);
    UserModel::setSession($user);
    Msg::push(Msg::INFO,'プロフィール情報を更新しました');
    redirect('editprofile');
    
}