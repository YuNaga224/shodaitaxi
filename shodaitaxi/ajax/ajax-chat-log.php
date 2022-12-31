<?php
// データベース接続
// データベース名
require_once 'c:/mamp/htdocs/shodaitaxiProject/shodaitaxi/php/db/datasource.php';

require_once 'c:/mamp/htdocs/shodaitaxiProject/shodaitaxi/config.php';
//Model
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';
require_once SOURCE_BASE . 'models/carpool.model.php';
require_once SOURCE_BASE . 'models/chat.model.php';

use db\DataSource;
use model\CarpoolModel;

session_start();
$carpool = CarpoolModel::getSession();


try {
    $db = new DataSource;
} catch (PDOException $e) {
    // 接続できなかったらvar_dumpの後に処理を終了する
    var_dump($e->getMessage());
    exit;
}


$sql = "SELECT id, nickname, body FROM chat where carpool_id = :carpool_id";

$stmt = $db->select($sql,[
    ":carpool_id" => $carpool->id
],'asc');


$productList = array();


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $productList[] = array(
        'id'    => $row['id'],
        'nickname'  => $row['nickname'],
        'body' => $row['body']
    );
}

// ヘッダーを指定することによりjsonの動作を安定させる
header('Content-type: application/json');
// htmlへ渡す配列$productListをjsonに変換する
echo json_encode($productList);