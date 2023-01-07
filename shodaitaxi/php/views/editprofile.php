<?php 
namespace view\editprofile;

use db\UserQuery;
use model\UserModel;

function index() {
    $user = UserModel::getSession();
    $user = UserQuery::fetchById($user->id);
?>
    <h1 class="sr-only">ログイン</h1>
    <div class="mt-5">
        <div class="text-center mb-4">
            <img src="<?php echo BASE_IMAGE_PATH;?>shodaitaxi_logo.png" width="75" alt="商大タクシーロゴ">
        </div>
        <div class="login-form bg-white p-4 shadow-sm mx-auto rounded">
            <form action="<?php echo CURRENT_URI; ?>" method="POST" class="validate-form" novalidate autocomplete="off">
                <div class="form-group">
                    <label for="id">ニックネーム</label>
                    <input type="text" id="nickname" name="nickname" class="form-control validate-target" required maxlength="8" tabindex="1" value="<?php echo $user->nickname;?>">
                    <div class="invalid-feedback"></div> 
                </div>
                <div class="form-group">
                    <label>学年</label>
                    <select name="grade" id="grade" class="form-control">
                        <option value="<?php echo $user->grade?>"><?php echo $user->grade?></option>
                        <option value="1年">１年</option>
                        <option value="2年">２年</option>
                        <option value="3年">３年</option>
                        <option value="4年">４年</option>
                    </select>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <div>
                        <input type="submit" value="確定" class="btn btn-primary shadow-sm">
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php 
}
?>
