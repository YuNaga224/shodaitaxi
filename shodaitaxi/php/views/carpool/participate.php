<?php

namespace view\carpool\participate;

use model\CarpoolModel;
use model\UserModel;

function index($fetchedCarpool)
{
    // var_dump($fetchedCarpool);
    $participate_count = 1;
    $user = UserModel::getSession();
    $carpool = CarpoolModel::getSession();
    // var_dump($user);
    
?>
    <h1 class="h4 d-flex justify-content-center mb-1 bg-white rounded p-3 mb-2"><?php echo $fetchedCarpool->selected_date ?> <?php echo $fetchedCarpool->selected_jr ?>のグループです</h1>
    <h1 class="h5 d-flex justify-content-center mb-3">メンバーが集まるのを待っています</h1>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title h6 md-h5"><?php echo $fetchedCarpool->user_1 ?></h4>
                </div>
            </div>
        </div>
        <div class="col-6">
            <?php if ($fetchedCarpool->user_2 === 'EHG23hNRVe') : ?>
                <div class="card  bg-dark">
                    <div class="card-body">
                        <h4 class="card-title h6 md-h5">参加待ち</h4>
                    </div>
                </div>
        </div>
            <?php else : $participate_count = 2;?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title h6 md-h5"><?php echo $fetchedCarpool->user_2 ?></h4>
                    </div>
                </div>
        </div>
            <?php endif; ?>
        <div class="col-6 mt-3">
            <?php if ($fetchedCarpool->user_3 === 'EHG23hNRVe') : ?>
                <div class="card  bg-dark">
                    <div class="card-body">
                        <h4 class="card-title h6 md-h5">参加待ち</h4>
                    </div>
                </div>
        </div>
            <?php else : $participate_count = 3;?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title h6 md-h5"><?php echo $fetchedCarpool->user_3 ?></h4>
                    </div>
                </div>
        </div>
            <?php endif; ?>
        <div class="col-6 mt-3">
            <?php if ($fetchedCarpool->user_4 === 'EHG23hNRVe') : ?>
                <div class="card  bg-dark">
                    <div class="card-body">
                        <h4 class="card-title h6 md-h5">参加待ち</h4>
                    </div>
                </div>
        </div>
            <?php else : ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title h6 md-h5"><?php echo $fetchedCarpool->user_4 ?></h4>
                    </div>
                </div>
        </div>
            <?php endif; ?>

        </div>
        <?php if($user->relate_carpool === 'none'): ?>
            <div class="col-auto">
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <div>
                        <a href="<?php the_url(GO_HOME) ?>">キャンセル</a>
                    </div>
                    <div>
                        <form action="<?php echo CURRENT_URI ?>" method="POST">
                            <input type="submit" value="参加" class="btn btn-primary shadow-sm">
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div>
                <div class="mt-3 d-flex justify-content-between">
                <?php if($user->user_num === 1): ?>
                    <form action="<?php the_url("carpool/dissolution"); ?>" method="POST">
                        <input type="submit" class="btn btn-danger" value="グループを解散">
                    </form>
                <?php else: ?>
                    <form action="<?php the_url("carpool/cancel")?>" method="POST">
                        <input type="submit" class="btn btn-danger" value="グループを抜ける">
                    </form>
                <?php endif; ?>
                    <a href="<?php the_url('ajax/meet.php?carpool_id=' . $carpool->id); ?>" class="btn btn-info shadow-sm px-5">チャットへ</a>
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text="<?php echo '🔶募集中！！🔶'."\n".$carpool->selected_date.$carpool->selected_jr.'のグループです'."\n".'現在参加者数：'. $participate_count .'/4人'."\n".'🚕💨💨💨💨💨'."\n".'下のリンクから参加してください🔽';?>" data-via="shodaitaxi" data-hashtags="商大タクシー" data-related="" data-lang="ja" data-show-count="false">ツイート</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                </div>
        <?php endif; ?>
        </div>
            
    </div>
</div>

<?php
}
?>