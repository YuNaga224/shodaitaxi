<?php 
namespace controller\carpool\meet;

use lib\Auth;
use model\CarpoolModel;
use model\UserModel;
use lib\Msg;

function get() {
    Auth::requireLogin();
    $user = UserModel::getSession();
    $carpool = CarpoolModel::getSession();
    if($user->relate_carpool === $carpool->rep_id) {
    
        // require_once SOURCE_BASE . "libs/chat-server.php";
        redirect("ajax/meet.php?carpool_id=" . $carpool->id);
        // \view\carpool\meet\index($user,$carpool);
    }else {
        Msg::push(Msg::ERROR,'不具合が発生しました。');
        redirect('404');
    }
}

?>