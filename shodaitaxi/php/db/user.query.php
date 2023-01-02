<?php 
namespace db;

use db\DataSource;
use model\UserModel;

class UserQuery {
    //idを指定してユーザーを取得
    public static function fetchById($id) {
        $db = new DataSource;
        $sql = 'select * from users where id = :id';

        $result = $db->selectOne($sql,[
            ':id' => $id
        ],DataSource::CLS,UserModel::class);
        return $result;
    }

    //新規ユーザーを登録
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

    //ユーザーに参加番号を付与
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

    //グループ参加ユーザーをcarpoolとidで紐づける
    public static function updateRelate($user) {
        $db = new DataSource;
        $sql = 'update users set relate_carpool = :relate_carpool where id = :id';
        return $db->execute($sql,[
            ':relate_carpool' => (string)$user->relate_carpool,
            ':id' => $user->id
        ]);
    }

    //ユーザーとcarpoolの紐づけを解消
    public static function clearRelate($user) {
        $db = new DataSource;
        $sql = 'update users set relate_carpool = "none" where id = :id';
        return $db->execute($sql,[
            ':id' => $user->id
        ]);
    }

    //ユーザーの参加番号をリセット
    public static function clearUserNum($user) {
        $db = new DataSource;
        $sql = 'update users set user_num = 0 where id = :id';
        return $db->execute($sql,[
            ':id' => $user->id
        ]);
    }

}