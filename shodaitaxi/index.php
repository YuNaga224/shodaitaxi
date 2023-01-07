<?php 

require_once 'config.php';

//ライブラリ
require_once SOURCE_BASE . 'libs/router.php';
require_once SOURCE_BASE . 'libs/helper.php';
require_once SOURCE_BASE . 'libs/auth.php';

//Model
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';
require_once SOURCE_BASE . 'models/carpool.model.php';

//メッセージ
require_once SOURCE_BASE . 'libs/message.php';

//データベース
require_once SOURCE_BASE . 'db/datasource.php';
require_once SOURCE_BASE . 'db/user.query.php';
require_once SOURCE_BASE . 'db/carpool.query.php';
require_once SOURCE_BASE . 'db/chat.query.php';

//partials
require_once SOURCE_BASE . 'partials/header.php';
require_once SOURCE_BASE . 'partials/carpool-list-item.php';
require_once SOURCE_BASE . 'partials/footer.php';

//view
require_once SOURCE_BASE . 'views/login.php';
require_once SOURCE_BASE . 'views/home.php';
require_once SOURCE_BASE . 'views/register.php';
require_once SOURCE_BASE . 'views/carpool/newcarpool.php';
require_once SOURCE_BASE . 'views/carpool/participate.php';
require_once SOURCE_BASE . 'views/carpool/done.php';
require_once SOURCE_BASE . 'views/editprofile.php';
require_once SOURCE_BASE . 'views/resetpassword.php';
require_once SOURCE_BASE . 'views/userdestroy.php';


use function lib\route;

session_start();

try {
    \partials\header();

    $url = parse_url(CURRENT_URI);
    $rpath = substr($url['path'],1);
    $method = strtolower($_SERVER['REQUEST_METHOD']);

    route($rpath, $method);

    \partials\footer();

}catch(Throwable $e) {

    die('<h1>不明なエラーが発生しました。時間をおいて再度お試しください</h1>');
}