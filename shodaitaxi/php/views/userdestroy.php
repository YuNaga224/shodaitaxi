<?php 
namespace view\userdestroy;

function index() {
    ?>
<h1 class="sr-only">アカウント作成</h1>
<div class="mt-5">
    <div class="login-form bg-white p-4 shadow-sm mx-auto rounded">
        <form class="validate-form" action="<?php echo CURRENT_URI; ?>" method="POST" novalidate autocomplete="off">
            <div class="form-group">
                 <label for="pwd">パスワードを入力</label>
                 <input id="pwd" type="password" name="pwd" minlength="6" required tabindex="2" pattern="[a-zA-Z0-9]+" class="form-control validate-target" tabindex="2"/>
                 <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="onemore_pwd">パスワードをもう一度入力</label>
                <input id="onemore_pwd" type="password" name="onemore_pwd" minlength="6" required tabindex="2" pattern="[a-zA-Z0-9]+" class="form-control validate-target" tabindex="2"/>
                <div class="invalid-feedback"></div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
     
                <div>
                    <input type="submit" value="アカウントを削除" class="btn btn-danger shadow-sm">
                </div>
            </div>

        </form>
    </div>
</div>
<?php 
}
 ?>
