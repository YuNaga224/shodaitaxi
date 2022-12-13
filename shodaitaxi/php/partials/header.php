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
        
        <!-- ファイル -->
        <script type="text/javascript" src="<?php echo BASE_JS_PATH ?>form-validate.js"></script>
      

    </head>
    <body>
        <div id="container">
            <header class="container my-2">
                <nav class="row align-items-center py-2">
                    <a href="<?php the_url('home')?>" class="col-md d-flex align-items-center mb-3 mb-md-0">
                        <img width="60" class="mr-2" src="<?php echo BASE_IMAGE_PATH;?>shodaitaxi_logo.png" alt="商大タクシーロゴ">
                        <span class="h2 font-weight-bold mb-0">商大TAXI</span>
                    </a>
                    <div class="col-md-auto">
                        <?php if(Auth::isLogin()) :?>
                            <a href="<?php the_url('logout')?>">ログアウト</a>
                        <?php else: ?>
                            <a href="<?php the_url('register')?>" class="btn btn-primary">登録</a>
                            <a href="<?php the_url('login')?>">ログイン</a>
                        <?php endif; ?>
                    </div>
                </nav>
            </header>
            <main class="container py-3">

<?php 
    Msg::flush();
}
?>