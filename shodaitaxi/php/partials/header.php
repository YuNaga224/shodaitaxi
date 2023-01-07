<?php 
namespace partials;

use lib\Msg;
use lib\Auth;
use model\UserModel;

function header() {

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="<?php echo BASE_IMAGE_PATH; ?>shodaitaxi_logo.png" sizes="16x16">
        <link rel="apple-touch-icon" href="<?php echo BASE_IMAGE_PATH; ?>shodaitaxi_logo.png" sizes="180x180">
        <title>商大タクシー</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo BASE_CSS_PATH?>style.css">
      

    </head>
    <body>
        <div id="container">
            <div id="g-nav">
                <ul>
                    <li><a class="" href="<?php the_url('editprofile');?>">プロフィール編集</a></li>
                    <li><a href="<?php the_url('resetpassword');?>">パスワード変更</a></li>
                    <li><a class="text-danger" href="<?php the_url('logout')?>">ログアウト</a></li>
                    <li><a class="btn btn-danger text-white" href="<?php the_url('userdestroy')?>">アカウント削除</a></li>
                </ul>
            </div>
            <header class="container my-2">
                <nav class="row align-items-center py-2 justify-content-between">
                    <a href="<?php the_url('home')?>" class="logo col-auto d-flex align-items-center mb-3 mb-md-0">
                        <img width="60" class="mr-2" src="<?php echo BASE_IMAGE_PATH;?>shodaitaxi_logo.png" alt="商大タクシーロゴ">
                        <span class="h2 font-weight-bold mb-0">商大TAXI</span>
                    </a>
                    
                        <?php if(Auth::isLogin()) :?>
                        <div class="col-auto">
                            <button class="openbtn">
                                <span class="burger-inline"></span>
                                <span class="burger-inline"></span>
                                <span class="burger-inline"></span>
                            </button>
                        </div>
                        <?php else: ?>
                        <div class="col-md-auto">
                            <a href="<?php the_url('register')?>" class="btn btn-primary">登録</a>
                            <a href="<?php the_url('login')?>">ログイン</a>
                        </div>
                        <?php endif; ?>
                </nav>
            </header>
            <main class="container py-3">

<?php 
    Msg::flush();
}
?>