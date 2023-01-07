<?php 
namespace model;
use lib\Auth;
use db\CarpoolQuery;
use lib\Msg;
use db\UserQuery;
class CarpoolModel extends AbstractModel {
    
    public int $id;
    public string $user_1 = "EHG23hNRVe";
    public string $user_2 = "EHG23hNRVe";
    public string $user_3 = "EHG23hNRVe";
    public string $user_4 = "EHG23hNRVe";
    public string $selected_date;
    public string $selected_jr;

    protected static $SESSION_NAME = '_carpool';

    //ユーザーがグループに参加中かどうかを判定する関数
    //返り値はbool
    public static function isParticipate($user) {

        if($user->relate_carpool != 'none') {
            return true;
        }else {
            return false;
        }
    }

    //この関数は修正が必要
    public static function isMembersReady($carpool) {
        if(empty($carpool)){
            Msg::push(Msg::ERROR, 'グループが解散されました');
            Auth::requireLogin();
            $user = UserModel::getSession();
            $carpool = CarpoolModel::getSession();
            if($user->user_num === 1) {
                CarpoolQuery::deleteRecord($carpool);
                UserQuery::clearUserNum($user);
                $user->user_num = 0;
            }else{
                CarpoolQuery::clearUser($carpool,$user);
                UserQuery::clearUserNum($user);
                $user->user_num = 0;
            }
            CarpoolModel::clearSession();
            $user->relate_carpool = "none";
            UserQuery::clearRelate($user);
            UserModel::setSession($user);
            redirect(GO_HOME);
        }elseif(!($carpool->user_4 === "EHG23hNRVe")){
            Msg::push(Msg::INFO,'メンバーが全員揃いました！');
        }else {
            return;
        }
    }

    //ユーザーがグループに参加していなかった場合ホーム画面にリダイレクトする関数
    public static function requireParticipate() {
        $user = UserModel::getSession();
        if(!static::isParticipate($user)){
            Msg::push(Msg::ERROR, 'グループに参加していません');
            redirect(GO_HOME);
        }
    }

}