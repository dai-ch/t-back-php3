<?php
//DB接続処理をまとめる
define('DSN','mysql:host=mysql;dbname=board;charset=utf8mb4');
define('DB_USER','root');
define('DB_PASS','root');

try{
  $pdo = new PDO(
DSN,
DB_USER,
DB_PASS,
[
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
  PDO::ATTR_EMULATE_PREPARES => false,
]
  );
}catch(PDOException $e){
echo $e->getMessage();
exit;
}

?>