<?php 
namespace view\login;

function index() {
?>
    <h1 class="sr-only">ログイン</h1>
    <div class="mt-5">
        <div class="text-center mb-4">
            <img src="<?php echo BASE_IMAGE_PATH;?>shodaitaxi_logo.png" width="75" alt="商大タクシーロゴ">
        </div>
        <div class="login-form bg-white p-4 shadow-sm mx-auto rounded">
            <form action="<?php echo CURRENT_URI; ?>" method="POST" class="validate-form" novalidate autocomplete="off">
                <div class="form-group">
                    <label for="id">ユーザーID</label>
                    <input id="id" type="text" name="id" minlength="4" class="form-control validate-target" required autofocus tabindex="1"/>
                    <div class="invalid-feedback"></div> 
                </div>
                <div class="form-group">
                    <label for="pwd">パスワード</label>
                    <input id="pwd" type="password" name="pwd" minlength="6" required pattern="[a-zA-Z0-9]+" class="form-control validate-target" tabindex="2"/>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <a href="<?php the_url('register') ?>">アカウント登録</a>
                    </div>
                    <div>
                        <input type="submit" value="ログイン" class="btn btn-primary shadow-sm">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php 
}
 ?>