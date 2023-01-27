<?php 
require_once 'c:/mamp/htdocs/shodaitaxiProject/shodaitaxi/php/db/datasource.php';

require_once 'c:/mamp/htdocs/shodaitaxiProject/shodaitaxi/config.php';
require_once SOURCE_BASE . 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
session_start();

//リクエストトークンを使い、アクセストークンを取得する
$twitter_connect = new TwitterOAuth(TWITTER_API_KEY, TWITTER_API_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
$access_token = $twitter_connect->oauth('oauth/access_token', array('oauth_verifier' => $_GET['oauth_verifier'], 'oauth_token'=> $_GET['oauth_token']));

//アクセストークンからユーザの情報を取得する
$user_connect = new TwitterOAuth(TWITTER_API_KEY, TWITTER_API_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$user_info = $user_connect->get('account/verify_credentials');//アカウントの有効性を確認するためのエンドポイント
?>
<?php  

    echo $user_info->name;
?>
<h2>ログイン成功</h2>

<h1>ログイン失敗</h1>

