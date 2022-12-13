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

session_start();
$carpool = CarpoolModel::getSession();

$host = 'aws-and-infra-web.ctatrguvwcnx.ap-northeast-1.rds.amazonaws.com';
// データベース名
$dbname = 'shodaitaxi';
// ユーザー名
$dbuser = 'shodaitaxi_dev';
// パスワード
$dbpass = 'shodai1121';

try {
    $dbh = new PDO("mysql:host={$host};port=3306;dbname={$dbname};charset=utf8mb4", $dbuser, $dbpass);
} catch (PDOException $e) {
    // 接続できなかったらvar_dumpの後に処理を終了する
    var_dump($e->getMessage());
    exit;
}

// データ取得用SQL
// 値はバインドさせる
$sql = "SELECT id, nickname, body FROM chat where carpool_id = ?";
// SQLをセット
$stmt = $dbh->prepare($sql);
// SQLを実行
$stmt->execute(array($carpool->id));

// あらかじめ配列$productListを作成する
// 受け取ったデータを配列に代入する
// 最終的にhtmlへ渡される
$productList = array();

// fetchメソッドでSQLの結果を取得
// 定数をPDO::FETCH_ASSOC:に指定すると連想配列で結果を取得できる
// 取得したデータを$productListへ代入する
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