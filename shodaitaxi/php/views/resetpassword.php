<?php
namespace view\resetpassword;

function index() {
?>
<h1 class="sr-only">アカウント作成</h1>
<div class="mt-5">
    <div class="login-form bg-white p-4 shadow-sm mx-auto rounded">
        <form class="validate-form" action="<?php echo CURRENT_URI; ?>" method="POST" novalidate autocomplete="off">
            <div class="form-group">
                <label for="current_pwd">現在のパスワード</label>
                <input id="current_pwd" type="password" name="current_pwd" minlength="6" required tabindex="2" pattern="[a-zA-Z0-9]+" class="form-control validate-target" tabindex="2"/>
                <div class="invalid-feedback"></div>

            </div>
            <div class="form-group">
                 <label for="new_pwd">新しいパスワード</label>
                 <input id="new_pwd" type="password" name="new_pwd" minlength="6" required tabindex="2" pattern="[a-zA-Z0-9]+" class="form-control validate-target" tabindex="2"/>
                 <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="onemore_pwd">新しいパスワードをもう一度入力</label>
                <input id="onemore_pwd" type="password" name="onemore_pwd" minlength="6" required tabindex="2" pattern="[a-zA-Z0-9]+" class="form-control validate-target" tabindex="2"/>
                <div class="invalid-feedback"></div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
     
                <div>
                    <input type="submit" value="変更する" class="btn btn-primary shadow-sm">
                </div>
            </div>

        </form>
    </div>
</div>
<?php 
}
 ?>
