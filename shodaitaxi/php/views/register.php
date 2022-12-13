<?php 
namespace view\register;

function index() {
?>
<h1 class="sr-only">アカウント作成</h1>
<div class="mt-5">
    <div class="text-center mb-4">
    <img src="<?php echo BASE_IMAGE_PATH;?>shodaitaxi_logo.png" width="75" alt="商大タクシーロゴ">
    </div>
    <div class="login-form bg-white p-4 shadow-sm mx-auto rounded">
        <form class="validate-form" action="<?php echo CURRENT_URI; ?>" method="POST" novalidate autocomplete="off">
            <div class="form-group">
                <label for="id">ユーザーID</label>
                <input type="text" name="id" class="form-control validate-target" minlength="4" required maxlength="20" pattern="[a-zA-Z0-9]+" autofocus tabindex="1"/>
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                 <label for="pwd">パスワード</label>
                 <input id="pwd" type="password" name="pwd" minlength="6" required tabindex="2" pattern="[a-zA-Z0-9]+" class="form-control validate-target" tabindex="2"/>
                 <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="nickname">名前</label>
                <input type="text" id="nickname" name="nickname" class="form-control validate-target" required maxlength="8" tabindex="3">
                <div class="invalid-feedback"></div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <a href="<?php the_url('login'); ?>">ログインへ</a>
                </div>
                <div>
                    <input type="submit" value="登録" class="btn btn-primary shadow-sm">
                </div>
            </div>

        </form>
    </div>
</div>
<?php 
}
 ?>