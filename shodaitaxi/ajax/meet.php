<?php 
namespace view\carpool\meet;
require_once 'c:/mamp/htdocs/shodaitaxiProject/shodaitaxi/php/db/datasource.php';

require_once 'c:/mamp/htdocs/shodaitaxiProject/shodaitaxi/config.php';
//Model
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';
require_once SOURCE_BASE . 'models/carpool.model.php';
require_once SOURCE_BASE . 'models/chat.model.php';

//library
require_once SOURCE_BASE . 'libs/router.php';
require_once SOURCE_BASE . 'libs/helper.php';
require_once SOURCE_BASE . 'libs/message.php';
require_once SOURCE_BASE . 'libs/auth.php';

use db\CarpoolQuery;
use model\CarpoolModel;
use model\UserModel;
use lib\Auth;
use lib\Msg;
session_start();
$user = UserModel::getSession();
$carpool = CarpoolModel::getSession();
Auth::requireLogin();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
    <link rel="icon" href="<?php echo BASE_IMAGE_PATH; ?>shodaitaxi_logo.png" sizes="16x16">
    <link rel="apple-touch-icon" href="<?php echo BASE_IMAGE_PATH; ?>shodaitaxi_logo.png" sizes="180x180">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_CSS_PATH ?>style.css">
    <title>商大タクシー</title>
</head>
<body>
<div id="container">
    <header class="sticky-top bg-white mt-0">
        <nav class="d-flex justify-content-around align-items-center py-2 p-1">

            <form class="" action="<?php the_url('carpool/done'); ?>" method="POST">
                <input type="submit"  class="btn btn-danger" value="タクシーに乗りました">
            </form>
            
            <a href="<?php the_url('carpool/participate?carpool_id=' . $carpool->id); ?>" class="btn btn-info">グループ管理</a>


        </nav>
    </header>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">

            <h1 class="h6" id="member-infomation">現在の参加者数は1/4人です</h1>



        </div>
        <div id="all_show_result" class="mt-5"></div>
        </div>
        <div class="add_chat" class="row d-flex align-items-center">
            <div class="d-flex justify-content-center">
                <input type="text" id="body" class="col-10 form-control chat-body" maxlength="50" required>
            </div>
            <div id="add_result"></div>
            <div class="d-flex justify-content-center text-align-center">
                <button id="ajax_add" class="btn btn-info mb-3 send-btn">送信</button>  
            </div>
        </div>
    </div>

    </div>
    <script src="ajax.js"></script>
</body>
</html>