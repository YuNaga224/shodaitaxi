<?php 
namespace db;

use db\DataSource;
use model\CarpoolModel;

class CarpoolQuery {

    public static function fetchRecruitCarpools() {

        $db = new DataSource;
        $sql = 'select * from carpool';

        $result = $db->select($sql,[],DataSource::CLS, CarpoolModel::class);
        return $result;
    }

    public static function fetchByUserId($user) {
        $db = new DataSource;
        $sql = 'select * from carpool where rep_id = :relate_carpool';
        $result = $db->selectOne($sql,[
            ':relate_carpool' => $user->relate_carpool,
        ],DataSource::CLS, CarpoolModel::class);
        return $result;
    }

    public static function createCarpool($carpool,$user) {

        $db = new DataSource;

        $sql = 'insert into carpool(rep_id,user_1,selected_date,selected_jr) values (:user_id,:nickname,:selected_date,:selected_jr)';

        return $db->execute($sql, [
            ':user_id' => $user->id,
            ':nickname' => $user->nickname,
            ':selected_date' => $carpool->selected_date,
            ':selected_jr' => $carpool->selected_jr
        ]);
    }

    public static function participateCarpool($carpool,$user) {

        $db = new DataSource;
        $sql = '';
        if($carpool->user_2 === 'EHG23hNRVe'){
            $sql = 'update carpool set user_2 = :nickname where id = :id';
        }elseif($carpool->user_3 === 'EHG23hNRVe'){
            $sql = 'update carpool set user_3 = :nickname where id = :id';
        }elseif($carpool->user_4 === 'EHG23hNRVe'){
            $sql = 'update carpool set user_4 = :nickname where id = :id';
        }

        return $db->execute($sql, [
            ':nickname' => $user->nickname,
            ':id' => $carpool->id
        ]);
    }

    public static function deleteRecord($dump_carpool){
        $db = new DataSource;
        $sql = 'delete from carpool where id = :id';
        return $db->execute($sql,[
            ':id' => $dump_carpool->id
        ]);
    }

    public static function fetchById($carpool) {
        $db = new DataSource;
        $sql = 'select * from carpool where id = :id';

        $result = $db->selectOne($sql,[
            ':id' => $carpool->id
        ],DataSource::CLS,CarpoolModel::class);

        return $result;
    }

    public static function clearUser($carpool,$user) {
        $db = new DataSource;
        $sql = "";
        if($user->user_num === 2){
            $sql = 'update carpool set user_2 = "EHG23hNRVe" where id = :id';
        }elseif($user->user_num === 3){
            $sql = 'update carpool set user_3 = "EHG23hNRVe" where id = :id';
        }elseif($user->user_num === 4){
            $sql = 'update carpool set user_4 = "EHG23hNRVe" where id = :id';
        }

        return $db->execute($sql,[
            ':id' => $carpool->id
        ]);
    }

}