<?php 
namespace db;

use PDO;

class PDOSingleton {
    private static $singleton;

    private function __construct($dsn,$username,$password)
    {
        $this->conn = new PDO($dsn,$username,$password);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    }

    public static function getInstance($dsn,$username,$password) {
        if(!isset(self::$singleton)) {
            $instance = new PDOSingleton($dsn, $username,$password);
            self::$singleton = $instance->conn;
        }

        return self::$singleton;
    }
}

class DataSource {

    private $conn;
    private $sqlResult;
    public const CLS = 'cls';


    public function __construct($host = 'aws-and-infra-web.ctatrguvwcnx.ap-northeast-1.rds.amazonaws.com', $port = '3306', $dbName = 'shodaitaxi', $username = 'shodaitaxi_dev', $password = 'shodai1121') {
        $dsn = "mysql:host={$host};port={$port};dbname={$dbName};";
        $this->conn = PDOSingleton::getInstance($dsn,$username,$password);

    }

    //最後に追加したデータのidを取得する
    public function getLastInsertId(){
        return $this->conn->lastInsertId();
    }

    //セレクト文（配列で取り出す）
    public function select($sql = "", $params = [], $type = '', $cls = '') {
        $stmt = $this->executeSql($sql,$params);

        if($type === static::CLS) {
            //classで取得
            return $stmt->fetchAll(PDO::FETCH_CLASS,$cls);

        }elseif($type === 'asc'){
            return $stmt;
        }else {

            return $stmt->fetchAll();

        }
    }


    public function execute($sql = "",$params=[]) {

        $this->executeSql($sql,$params);
        return $this->sqlResult;
    }

    //一つの要素のみを取り出す
    public function selectOne($sql = "",$params = [],$type = '',$cls = '') {

        $result = $this->select($sql,$params,$type,$cls);
        return count($result) > 0 ? $result[0] : false;
    }

    public function begin() {

        $this->conn->beginTransaction();
    }

    public function commit() {

        $this->conn->commit();
    }

    public function rollback() {

        $this->conn->rollback();
    }


    private function executeSql($sql,$params) {

        $stmt = $this->conn->prepare($sql);
        $this->sqlResult = $stmt->execute($params);
        return $stmt;

    }


}