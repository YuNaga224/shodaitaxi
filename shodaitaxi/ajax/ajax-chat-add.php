<?php
require_once 'c:/mamp/htdocs/shodaitaxiProject/shodaitaxi/php/db/datasource.php';

require_once 'c:/mamp/htdocs/shodaitaxiProject/shodaitaxi/config.php';

require_once SOURCE_BASE . 'libs/helper.php';
//Model
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';
require_once SOURCE_BASE . 'models/carpool.model.php';



use model\CarpoolModel;
use model\UserModel;

session_start();
// POSTメソッドでリクエストした値を取得
$body = $_POST['body'];
$body = escape($body);
$user = UserModel::getSession();
$carpool = CarpoolModel::getSession();


// データベース接続
// $host = localhostで動かなければipアドレスを記載
$host = 'localhost';
// データベース名
$dbname = 'shodaitaxi';
// ユーザー名
$dbuser = 'shodaitaxi_dev';
// パスワード
$dbpass = 'shodai1121';

// データベース接続クラスPDOのインスタンス$dbhを作成する
try {
    $dbh = new PDO("mysql:host={$host};port=8889;dbname={$dbname};charset=utf8mb4", $dbuser, $dbpass);
// PDOExceptionクラスのインスタンス$eからエラーメッセージを取得
} catch (PDOException $e) {
    // 接続できなかったらvar_dumpの後に処理を終了する
    var_dump($e->getMessage());
    exit;
}

// データ追加用SQL
// 値はバインドさせる
$sql = "INSERT INTO chat(carpool_id, nickname, body) VALUES(?, ?, ?)";
// SQLをセット
$stmt = $dbh->prepare($sql);
// SQLを実行
$stmt->execute(array($carpool->id, $user->nickname, $body));

// 先ほど追加したデータを取得
// idはlastInsertId()で取得できる
$last_id = $dbh->lastInsertId();
// データ追加用SQL
// 値はバインドさせる
$sql = "SELECT id, user_id, body FROM chat WHERE id = ?";
// SQLをセット
$stmt = ($dbh->prepare($sql));
// SQLを実行
$stmt->execute(array($last_id));

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