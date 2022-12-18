<?php 
namespace db;

class ChatQuery{
    public static function deleteRecord($carpool) {
        $db = new DataSource;

        $sql = 'delete from chat where carpool_id = :carpool_id';

        return $db->execute($sql,[
            ':carpool_id' => $carpool->id
        ]);

    }

    public static function infoJoin($carpool,$user){
        $db = new DataSource;

        $sql = 'insert into chat(carpool_id,nickname,body) values (:carpool, :info, :body)';

        return $db->execute($sql,[
            ':carpool' => $carpool->id,
            ':info' => "[参加お知らせ]",
            ':body' => $user->nickname . "さんがグループに参加しました！"
        ]);
    }

    public static function infoLeave($carpool,$user){
        $db = new DataSource;

        $sql = 'insert into chat(carpool_id,nickname,body) values (:carpool, :info, :body)';

        return $db->execute($sql,[
            ':carpool' => $carpool->id,
            ':info' => "[辞退お知らせ]",
            ':body' => $user->nickname . "さんがグループを抜けました。"
        ]);
    }
}