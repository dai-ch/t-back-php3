<?php
//データベース接続文字列
define('DSN','mysql:host=mysql;dbname=todoList;charset=utf8mb4');
//接続ユーザー名
define('DB_USER','root');
//接続時のパスワード
define('DB_PASS','root');

try{
  $pdo = new PDO(
DSN,
DB_USER,
DB_PASS,
[
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]
  );
echo 'DB接続に成功!!';

}catch(PDOException $e){
echo $e->getMessage();
exit;
}finally{
  $pdo = null;
}


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>PHPで掲示板アプリ</title>
  </head>
  <body>
    <h1>掲示板</h1>
    <h2>新規投稿</h2>

    <form action='./finished.php' method="POST">
      name: <input type="text" name="title"><br />
      投稿内容:<br />
      <textarea name="text" cols="30" rows="10"></textarea><br />
      <input type="button" value="投稿">
    </form>


  </body>
</html>