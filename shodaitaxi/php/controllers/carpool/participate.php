<?php 
namespace controller\carpool\participate;

use db\CarpoolQuery;
use db\ChatQuery;
use Throwable;
use db\UserQuery;
use lib\Auth;
use model\CarpoolModel;
use lib\Msg;
use model\UserModel;

function get() {
    Auth::requireLogin();
    $carpool = new CarpoolModel;
    $carpool->id = get_param('carpool_id' , null ,false);

    $fetchedCarpool = CarpoolQuery::fetchById($carpool);
    
    CarpoolModel::isMembersReady($fetchedCarpool);

    if(empty($fetchedCarpool)) {
        Msg::push(Msg::ERROR,'申し訳ございません。ご指定のグループはみつかりませんでした。');
        redirect('404');
    }

    \view\carpool\participate\index($fetchedCarpool);
}

function post() {
    Auth::requireLogin();
    $user = UserModel::getSession();
    if(CarpoolModel::isParticipate()){
        Msg::push(Msg::ERROR,'すでにグループに参加しています');
        redirect(GO_HOME);
        return;
    }
    $carpool = new CarpoolModel;

    $carpool->id = get_param('carpool_id' , null, false);
    try{

        $fetchedCarpool = CarpoolQuery::fetchById($carpool);
        $user->relate_carpool = $fetchedCarpool->rep_id;
        $user = UserQuery::userNum($user,$fetchedCarpool);
        $is_success1 = UserQuery::updateRelate($user);
    
        $is_success2 = CarpoolQuery::participateCarpool($fetchedCarpool,$user);
    }catch(Throwable $e) {
        Msg::push(Msg::DEBUG,$e->getMessage());
        $is_success1 = false;
        $is_success2 = false;
    }

    if($is_success1 && $is_success2) {
        UserModel::setSession($user);
        $fetchedCarpool = CarpoolQuery::fetchById($fetchedCarpool);
        CarpoolModel::setSession($fetchedCarpool);
        ChatQuery::infoJoin($fetchedCarpool,$user);
        redirect("ajax/meet.php?carpool_id=" . $fetchedCarpool->id);
    }else {
        Msg::push(Msg::ERROR,'グループへの参加に失敗しました。');
        redirect(GO_REFERER);
    }

    
}