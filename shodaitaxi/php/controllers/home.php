<?php 
namespace controller\home;
use db\CarpoolQuery;
use db\ChatQuery;
use db\UserQuery;
use model\CarpoolModel;
use model\UserModel;

function get() {
    $carpools = CarpoolQuery::fetchRecruitCarpools();
    $requested_carpools = [];
    $carpool_list = [];
    foreach($carpools as $carpool) {
        if(date('m月d日') > date($carpool->selected_date)){
            if($user = UserModel::getSession() != null){
                $user = UserModel::getSession();
                $user->relate_carpool = 'none';
                $user->user_num = 0;
                UserQuery::clearRelate($user);
                UserQuery::clearUserNum($user);
                UserModel::setSession($user);
            }
            if(CarpoolModel::getSession() != null){
                CarpoolModel::clearSession();
            }
            CarpoolQuery::deleteRecord($carpool);
            ChatQuery::deleteRecord($carpool);
        }
        if($carpool->selected_date === get_param('date','',false) && $carpool->selected_jr === get_param('jr','',false)) {
            $requested_carpools[] = $carpool;
        }
        if(date('m月d日') == date($carpool->selected_date) && date('H:i着') < date($carpool->selected_jr)) {
            $carpool_list[] = $carpool;
        }
        if(date('m月d日') < date($carpool->selected_date)){
            $carpool_list[] = $carpool;
        }
    }  

    \view\home\index($requested_carpools,$carpool_list);
}
?>