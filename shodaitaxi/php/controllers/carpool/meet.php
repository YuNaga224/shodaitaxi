<?php 
namespace controller\carpool\meet;

use lib\Auth;
use model\CarpoolModel;
use model\UserModel;
use lib\Msg;

function get() {
    //ログインを要求
    Auth::requireLogin();
    //グループへの参加を要求
    CarpoolModel::requireParticipate();
    //sessionから情報を取得
    $user = UserModel::getSession();
    $carpool = CarpoolModel::getSession();

    //ユーザーがグループに紐づいている場合の処理
    if($user->relate_carpool === $carpool->id) {
    
        // require_once SOURCE_BASE . "libs/chat-server.php";
        redirect("ajax/meet.php?carpool_id=" . $carpool->id);
        // \view\carpool\meet\index($user,$carpool);
    }else {
        Msg::push(Msg::ERROR,'不具合が発生しました。');
        redirect('404');
    }
}

?>