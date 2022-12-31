<?php
require_once 'c:/mamp/htdocs/shodaitaxiProject/shodaitaxi/php/db/datasource.php';

require_once 'c:/mamp/htdocs/shodaitaxiProject/shodaitaxi/config.php';

require_once SOURCE_BASE . 'libs/helper.php';
//Model
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';
require_once SOURCE_BASE . 'models/carpool.model.php';

use db\DataSource;
use model\CarpoolModel;
use model\UserModel;

session_start();
// POSTメソッドでリクエストした値を取得
$body = $_POST['body'];
$body = escape($body);
$user = UserModel::getSession();
$carpool = CarpoolModel::getSession();

try {

    $db = new DataSource;
// PDOExceptionクラスのインスタンス$eからエラーメッセージを取得
} catch (PDOException $e) {
    // 接続できなかったらvar_dumpの後に処理を終了する
    var_dump($e->getMessage());
    exit;
}


$sql = "insert into chat(carpool_id, nickname, body) values(:carpool_id, :nickname, :body)";
$db->execute($sql,[
    ':carpool_id' => $carpool->id,
    ':nickname' => $user->nickname,
    ':body' => $body
]);

$last_id = $db->getLastInsertId();

$sql = "select id, user_id, body from chat where id = :id";
$stmt = $db->select($sql, [
    ':id' => $last_id
],'asc');


$chatList = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $chatList[] = array(
        'id'    => $row['id'],
        'nickname'  => $row['nickname'],
        'body' => $row['body']
    );
}

// ヘッダーを指定することによりjsonの動作を安定させる
header('Content-type: application/json');
// htmlへ渡す配列$chatListをjsonに変換する
echo json_encode($chatList);