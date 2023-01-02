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
    //carpoolインスタンス生成
    $carpool = new CarpoolModel;
    $carpool->id = get_param('carpool_id' , null ,false);
    //getで取得したidでレコードを取得
    $fetchedCarpool = CarpoolQuery::fetchById($carpool);
    
    //レコードを取得できたかどうかで場合分け
    if(empty($fetchedCarpool)) {
        //取得できなかった場合
        Msg::push(Msg::ERROR,'申し訳ございません。ご指定のグループはみつかりませんでした。');
        redirect(GO_HOME);
    }else{
        //取得できた場合
        //指定されたidのグループ参加ページに遷移
        CarpoolModel::isMembersReady($fetchedCarpool);
        \view\carpool\participate\index($fetchedCarpool);
    }

}

function post() {

    Auth::requireLogin();
    $user = UserModel::getSession();
    //ユーザーが既にグループに参加している場合、ホーム画面にリダイレクトさせる
    if(CarpoolModel::isParticipate($user)){
        Msg::push(Msg::ERROR,'すでにグループに参加しています');
        redirect(GO_HOME);
        return;
    }

    $carpool = new CarpoolModel;

    $carpool->id = get_param('carpool_id' , null, false);
    try{
        //idでcarpoolを取得
        $fetchedCarpool = CarpoolQuery::fetchById($carpool);
        //userテーブルのuser_numを設定
        $user = UserQuery::userNum($user,$fetchedCarpool);
        
        //userとcarpoolを紐づけ
        $user->relate_carpool = $fetchedCarpool->id;
        $is_success1 = UserQuery::updateRelate($user);
        //carpoolテーブルにuserのnicknameを登録
        $is_success2 = CarpoolQuery::participateCarpool($fetchedCarpool,$user);
    }catch(Throwable $e) {
        Msg::push(Msg::DEBUG,$e->getMessage());
        $is_success1 = false;
        $is_success2 = false;
    }

    if($is_success1 && $is_success2) {
        //セッション情報を更新
        UserModel::setSession($user);
        $fetchedCarpool = CarpoolQuery::fetchById($fetchedCarpool);
        CarpoolModel::setSession($fetchedCarpool);
        //ユーザー参加情報をchatテーブルに挿入
        ChatQuery::infoJoin($fetchedCarpool,$user);
        //chatページへ遷移
        redirect("ajax/meet.php?carpool_id=" . $fetchedCarpool->id);
    }else {
        Msg::push(Msg::ERROR,'グループへの参加に失敗しました。');
        redirect(GO_REFERER);
    }

    
}