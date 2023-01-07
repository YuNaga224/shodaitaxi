<?php
// データベース接続
// データベース名
require_once '/var/www/html/shodaitaxiProject/shodaitaxi/php/db/datasource.php';

require_once '/var/www/html/shodaitaxiProject/shodaitaxi/config.php';
//Model
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';
require_once SOURCE_BASE . 'models/carpool.model.php';
require_once SOURCE_BASE . 'models/chat.model.php';

use db\DataSource;
use model\CarpoolModel;
use model\UserModel;

session_start();
$user = UserModel::getSession();
$carpool = CarpoolModel::getSession();

try {
    $db = new DataSource;
} catch (PDOException $e) {
    var_dump($e->getMessage());
    exit;
}

//chatテーブルからcarpool_idを指定してレコードを取得
$sql = "select id, user_id, nickname, body from chat where carpool_id = :carpool_id";

$stmt = $db->select($sql,[
    ":carpool_id" => $carpool->id
],'asc');


$chatList = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $chatList[] = array(
        'id'    => $row['id'],
        'user_id' => $row['user_id'],
        'nickname'  => $row['nickname'],
        'body' => $row['body'],
        'current_user' => $user->id
    );
}



// ヘッダーを指定することによりjsonの動作を安定させる
header('Content-type: application/json');
// htmlへ渡す配列$chatListをjsonに変換する
echo json_encode($chatList);
