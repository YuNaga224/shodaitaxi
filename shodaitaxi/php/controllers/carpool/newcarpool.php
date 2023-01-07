<?php 
namespace controller\carpool\newcarpool;
use db\CarpoolQuery;
use db\ChatQuery;
use db\UserQuery;
use lib\Auth;
use model\CarpoolModel;
use model\UserModel;
use Throwable;
use lib\Msg;
function get() {
    Auth::requireLogin();
    \view\carpool\newcarpool\index();
}

function post() {
    Auth::requireLogin();
    //carpoolインスタンスを生成
    $carpool = new CarpoolModel;
    $carpool->selected_date = get_param('date',"");
    $carpool->selected_jr = get_param("jr","");

    try {
        //ユーザー情報をセッションから取得
        $user = UserModel::getSession();
        //グループ内で使用するuserNumを設定
        $user = UserQuery::userNum($user,$carpool);
        //carpoolテーブルに新規レコードを追加して追加したレコードを返り値として取得
        $carpool = CarpoolQuery::createCarpool($carpool,$user);
        $carpool != null ? $is_success1=true: $is_success1=false;
    
        //userとcarpoolを紐づけ
        $user->relate_carpool = $carpool->id;
        $is_success2 = UserQuery::updateRelate($user);

    }catch(Throwable $e) {
        Msg::push(Msg::DEBUG,$e->getMessage());
        $is_success1 = false;
        $is_success2 = false;
    }

    if($is_success1 && $is_success2) {
        //session情報を更新
        UserModel::setSession($user);
        CarpoolModel::setSession($carpool);
        ChatQuery::infoCreate($carpool,$user);
        redirect('ajax/meet.php?carpool_id=' . $carpool->id);
    }else {
        Msg::push(Msg::ERROR,'グループの作成に失敗しました');
        redirect(GO_REFERER);
    }
    
}
?>