<?php 
namespace db;

use db\DataSource;
use model\CarpoolModel;

class CarpoolQuery {

    //carpoolテーブルからレコードを全件取得
    public static function fetchRecruitCarpools() {

        $db = new DataSource;
        $sql = 'select * from carpool';

        $result = $db->select($sql,[],DataSource::CLS, CarpoolModel::class);
        return $result;
    }

    //userと紐づいたcarpoolテーブルのレコードを取得
    public static function fetchByUserId($user) {
        $db = new DataSource;
        $sql = 'select * from carpool where id = :relate_carpool';
        $result = $db->selectOne($sql,[
            ':relate_carpool' => (int)$user->relate_carpool,
        ],DataSource::CLS, CarpoolModel::class);
        return $result;
    }

    //carpoolテーブルに新たなレコードを挿入して、そのレコードを返り値とする関数
    public static function createCarpool($carpool,$user) {

        $db = new DataSource;
        
        $sql = 'insert into carpool(user_1,selected_date,selected_jr) values (:nickname,:selected_date,:selected_jr)';

        $db->execute($sql, [
            ':nickname' => $user->nickname,
            ':selected_date' => $carpool->selected_date,
            ':selected_jr' => $carpool->selected_jr
        ]);
        //最後に挿入した値のidを取得
        $last_id = $db->getLastInsertId();
        $sql = "select * from carpool where id = :id";
        return $db->selectOne($sql,[
            ':id' => $last_id
        ],DataSource::CLS, CarpoolModel::class);
    }

    //carpoolテーブルにユーザーのnicknameを登録
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

    //指定されたidのcarpoolレコードを削除
    public static function deleteRecord($dump_carpool){
        $db = new DataSource;
        $sql = 'delete from carpool where id = :id';
        return $db->execute($sql,[
            ':id' => $dump_carpool->id
        ]);
    }

    //指定されたidのレコードを取得
    public static function fetchById($carpool) {
        $db = new DataSource;
        $sql = 'select * from carpool where id = :id';

        $result = $db->selectOne($sql,[
            ':id' => $carpool->id
        ],DataSource::CLS,CarpoolModel::class);

        return $result;
    }

    //グループから抜けたユーザーのnicknameを削除
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