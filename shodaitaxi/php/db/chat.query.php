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
}