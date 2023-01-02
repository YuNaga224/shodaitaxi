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
use lib\Msg;

session_start();
// POSTメソッドでリクエストした値を取得
$body = $_POST['body'];
//XSS対策
$body = escape($body);
$user = UserModel::getSession();
$carpool = CarpoolModel::getSession();

try {

    $db = new DataSource;
// PDOExceptionクラスのインスタンス$eからエラーメッセージを取得
} catch (PDOException $e) {
    Msg::push(Msg::DEBUG, $e->getMessage());
    exit;
}

//chatテーブルにレコードを挿入
$sql = "insert into chat(carpool_id, nickname, body, user_id) values(:carpool_id, :nickname, :body, :user_id)";

$db->execute($sql,[
    ':carpool_id' => $carpool->id,
    ':user_id' => $user->id,
    ':nickname' => $user->nickname,
    ':body' => $body
]);

$last_id = $db->getLastInsertId();

$sql = "select id, user_id, nickname, body from chat where id = :id";
$stmt = $db->select($sql, [
    ':id' => $last_id
],'asc');


$chatList = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $chatList[] = array(
        'id'    => $row['id'],
        'user_id'  => $row['user_id'],
        'nickname' => $row['nickname'],
        'body' => $row['body'],
        'current_user' => $user->id
    );
}


// ヘッダーを指定することによりjsonの動作を安定させる
header('Content-type: application/json');
// htmlへ渡す配列$chatListをjsonに変換する
echo json_encode($chatList);