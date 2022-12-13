<?php

namespace view\home;

use db\CarpoolQuery;
use db\UserQuery;
use lib\Auth;
use model\UserModel;
use model\CarpoolModel;

function index($requested_carpools,$carpool_list)
{
    
    $participate_flg = false;
    if(Auth::isLogin()) {
        $user = UserModel::getSession();
        $carpool = CarpoolModel::getSession();
        if(!($user->relate_carpool === 'none')) {
            if(empty(CarpoolQuery::fetchById($carpool))){
                $participate_flg = false;
                $user->relate_carpool = 'none';
                $user->user_num = 0;
                UserQuery::clearRelate($user);
                UserQuery::clearUserNum($user);
                UserModel::setSession($user);
                CarpoolModel::clearSession();
            }else {
                $participate_flg = true;

            }
        }
    }
?>
    <ul class="container">
        <?php if($participate_flg): ?>
            <div class="row d-flex justify-content-center mb-5 bg-white p-5 rounded">
                <div class="h4">現在参加中の</div>
                <div class="h4">グループが存在します</div>
            </div>
        <?php elseif(!empty($requested_carpools)): ?>
        <?php
            foreach ($requested_carpools as $requested_carpool) {
                $url = get_url('carpool/participate?carpool_id=' . $requested_carpool->id);
                if($requested_carpool->user_4 === "EHG23hNRVe"){
                    \partials\carpool_list_item($requested_carpool,$url);
                }
            }
        ?>
        <?php elseif(!empty($carpool_list) && (get_param('jr','',false))==='' && (get_param('jr','',false))===''): ?>
            <?php 
                foreach($carpool_list as $carpool) {
                    $url = get_url('carpool/participate?carpool_id=' . $carpool->id);
                    if($carpool->user_4 === "EHG23hNRVe"){
                        \partials\carpool_list_item($carpool,$url);
                    }
                }
                
                ?>
        <?php elseif(empty($requested_carpools)): ?>
            <div class="d-flex align-items-center flex-column justify-content-center mt-1 bg-white mb-2 rounded">
                <h1 class="h4 mt-3">選択中の日時での<br>募集はありません</h1>
                <h2 class="h4">新規募集から</h2>
                <h3 class="h4">メンバーを集めましょう！</h3>
                <a href="<?php the_url('carpool/newcarpool')?>" class="btn btn-info mt-3 px-5 mb-3">新規募集</a>
            </div>
        <?php endif; ?>
        <?php if($participate_flg): ?>
            <div class="d-flex justify-content-center mb-3">
                <a href="<?php the_url('carpool/participate?carpool_id=' . $carpool->id); ?>" class="btn btn-info">参加中のグループへ移動</a>
            </div>
            <div class="text-center mb-4">
                <img src="<?php echo BASE_IMAGE_PATH;?>shodaitaxi_logo.png" width="100" alt="商大タクシーロゴ">
            </div>
        <?php else: ?>
                <form action="<?php echo CURRENT_URI?>" method="GET">
                <div class="form-group">
                    <label for="date">日付</label>
                    <select name="date" id="date" required class="form-control">
                        <?php if(!empty($_GET['date'])) : ?>
                            <optgroup label="現在選択中">
                        <option value="<?php echo $_GET['date']?>" selected><?php echo $_GET['date'] ?></option>
                        <?php else: ?>
                            <option value="">選択してください</option>
                        <?php endif; ?>
                    </optgroup>
                        <option value="<?php echo date('m月d日')?>"><?php echo date('m月d日')?></option>
                        <option value="<?php echo date('m月d日',strtotime('+1 day'))?>"><?php echo date('m月d日',strtotime('+1 day'))?></option>
                        <option value="<?php echo date('m月d日',strtotime('+2 day'))?>"><?php echo date('m月d日',strtotime('+2 day'))?></option>
                    </select>

                    <label for="jr">札幌方面→小樽のJR</label>
                    <select name="jr" id="jr" required class="form-control">
                        <?php  if(!empty($_GET['jr'])) :?>
                            <optgroup label="現在選択中">
                            <option value="<?php echo $_GET['jr']?>" selected><?php echo $_GET['jr'] ?></option>
                            <?php else: ?>
                                <option value="">選択してください</option>
                            <?php endif;?>

                        </optgroup>
                        <optgroup label="１講に間に合う">
                            <option value="08:01着">08:01着</option>
                            <option value="08:22着">08:22着</option>
                            <option value="08:35着">08:35着</option>
                        </optgroup>
                            <optgroup label="２講に間に合う">
                            <option value="09:45着">09:45着(快速エアポート)</option>
                            <option value="10:01着">10:01着</option>
                            <option value="10:22着">10:22着(快速エアポート)</option>
                        </optgroup>
                        <optgroup label="３講に間に合う">
                            <option value="11:47着">11:47着(快速エアポート)</option>
                            <option value="12:12着">12:12着</option>
                            <option value="12:22着">12:22着(快速エアポート)</option>
                            <option value="12:41着">12:41着</option>
                        </optgroup>
                            <optgroup label="４講に間に合う">
                            <option value="13:46着">13:46着(快速エアポート)</option>
                            <option value="14:14着">14:14着</option>
                            <option value="14:21着">14:21着(快速エアポート)</option>
                        </optgroup>
                        <optgroup label="５講に間に合う">
                            <option value="15:45着">15:45着(快速エアポート)</option>
                            <option value="15:54着">15:54着</option>

                        </optgroup>
                            <optgroup label="６講に間に合う">
                            <option value="17:22着">17:22着(快速エアポート)</option>
                            <option value="17:31着">17:31着</option>
                        </optgroup>
                        <optgroup label="７講に間に合う">
                            <option value="18:47着">18:47着(快速エアポート)</option>
                            <option value="19:12着">19:12着</option>
                        </optgroup>
                    </select>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                <input type="submit" value="検索" class="btn btn-primary shadow-sm">
                <button class="btn btn-info shadow-sm px-5" onclick="reload()">更新する</button>
            </div>
        </form>
    </ul> 
    <div class="d-flex justify-content-center">
        <a href="<?php the_url('carpool/newcarpool')?>" class="btn btn-info mt-1 px-5 mb-3">新規募集</a>

    </div>
    
    <?php endif; ?>
<?php
}
?>