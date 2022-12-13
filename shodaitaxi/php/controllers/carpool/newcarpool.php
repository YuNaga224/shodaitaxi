<?php 
namespace controller\carpool\newcarpool;
use db\CarpoolQuery;
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

    $carpool = new CarpoolModel;
    $carpool->selected_date = get_param('date',"");
    $carpool->selected_jr = get_param("jr","");

    try {
        $user = UserModel::getSession();
        $user = UserQuery::userNum($user,$carpool);
        $carpool->user_1 = $user->id;
        $user->relate_carpool = $user->id;
        $is_success1 = CarpoolQuery::createCarpool($carpool,$user);
        $is_success2 = UserQuery::repRelate($user);

    }catch(Throwable $e) {
        Msg::push(Msg::DEBUG,$e->getMessage());
        $is_success1 = false;
        $is_success2 = false;
    }

    if($is_success1 && $is_success2) {
        Msg::push(Msg::INFO,'グループの作成に成功しました');
        UserModel::setSession($user);
        $carpool = CarpoolQuery::fetchByUserId($user);
        CarpoolModel::setSession($carpool);
        redirect('carpool/participate?carpool_id=' . $carpool->id);
    }else {
        Msg::push(Msg::ERROR,'グループの作成に失敗しました');
        redirect(GO_REFERER);
    }
    
}
?>