<?php 
namespace controller\register;

use lib\Auth;
use lib\Msg;
use model\UserModel;
use Abraham\TwitterOAuth\TwitterOAuth;
function get() {
    $connection = new TwitterOAuth(TWITTER_API_KEY,TWITTER_API_SECRET);
    $request_token = $connection->oauth('oauth/request_token',array('oauth_callback'=> the_url('apis/twitter.callback.php')));
    $_SESSION['oauth_token'] = $request_token['oauth_token'];
    $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

    $oauthurl = $connection->url('oauth/authorize',array('oauth_token'=>$request_token['oauth_token']));


    \view\register\index($oauthurl);
}

function post() {
    $user = new UserModel;
    $user->id = get_param('id','');
    $user->pwd = get_param('pwd', '');
    $user->nickname = get_param('nickname', '');
    $user->relate_carpool = 'none';
    if(Auth::regist($user)) {
        Msg::push(Msg::INFO, "{$user->nickname}さん、ようこそ！");
        redirect(GO_HOME);
    }else {

        redirect(GO_REFERER);
    }
}