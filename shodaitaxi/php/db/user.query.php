<?php 
namespace db;

use db\DataSource;
use model\UserModel;

class UserQuery {
    public static function fetchById($id) {
        $db = new DataSource;
        $sql = 'select * from users where id = :id';

        $result = $db->selectOne($sql,[
            ':id' => $id
        ],DataSource::CLS,UserModel::class);
        return $result;
    }

    public static function insert($user) {

        $db = new DataSource;
        $sql = 'insert into users(id,pwd,nickname) values (:id, :pwd, :nickname)';

        $user->pwd = password_hash($user->pwd, PASSWORD_DEFAULT);

        return $db->execute($sql,[
            ':id' => $user->id,
            ':pwd' => $user->pwd,
            ':nickname' => $user->nickname,
        ]);
    }

    public static function repRelate($user) {
        $db = new DataSource;
        $sql = 'update users set relate_carpool = :rep_id where id = :id';
        $rep_user = $user->id;
        return $db->execute($sql,[
            ':rep_id' => $rep_user,
            ':id' => $user->id
        ]);

    }

    public static function userNum($user,$carpool) {
        $db = new DataSource;
        $sql = '';
        if($carpool->user_1 === 'EHG23hNRVe'){
            $user->user_num = 1;
            $sql = 'update users set user_num = 1 where id = :id';
        }elseif($carpool->user_2 === 'EHG23hNRVe'){
            $user->user_num = 2;
            $sql = 'update users set user_num = 2 where id = :id';
        }elseif($carpool->user_3 === 'EHG23hNRVe'){
            $user->user_num = 3;
            $sql = 'update users set user_num = 3 where id = :id';
        }elseif($carpool->user_4 === 'EHG23hNRVe'){
            $user->user_num = 4;
            $sql = 'update users set user_num = 4 where id = :id';
        }

        $db->execute($sql,[
            ':id' => $user->id
        ]);
        return $user;
    }

    public static function updateRelate($user) {
        $db = new DataSource;
        $sql = 'update users set relate_carpool = :relate_carpool where id = :id';
        return $db->execute($sql,[
            ':relate_carpool' => $user->relate_carpool,
            ':id' => $user->id
        ]);
    }

    public static function clearRelate($user) {
        $db = new DataSource;
        $sql = 'update users set relate_carpool = "none" where id = :id';
        return $db->execute($sql,[
            ':id' => $user->id
        ]);
    }

    public static function clearUserNum($user) {
        $db = new DataSource;
        $sql = 'update users set user_num = 0 where id = :id';
        return $db->execute($sql,[
            ':id' => $user->id
        ]);
    }

}