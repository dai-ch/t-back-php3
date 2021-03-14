<?php
define('DSN','mysql:host=mysql;dbname=todoList;charset=utf8mb4');
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

//特殊な文字を記号のまま出力する ENT_QUOTESは''や""も変換対象にする
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


function getTodos($pdo){
  //SQL文を作成、格納
  $stmt = $pdo->query("SELECT * FROM todos  ORDER BY id ASC");
  //totosにSQL文を指定しfetchAllで実行
  $todos = $stmt->fetchAll();
  return $todos;
}
//todoListデータベースの接続情報を取し$todosへ格納
$todos = getTodos($pdo);


function addTodo($pdo){

  //HTTPヘッダーから取得。trimで空白を削除
  //「HTTPヘッダー」は、データ本体の前に送られてくる、各種の状態を示す情報が入れられている部分。
  $name = trim(filter_input(INPUT_POST,'name'));
  $text = trim(filter_input(INPUT_POST,'text'));

  if($name === '' || $text === '' ){
    return;
  }
  //DBに値を追加する準備(:〇〇はプレイスフォルダを表す。パラメータの置き場所)
  $stmt = $pdo->prepare("INSERT INTO todos(name,text) VALUES (:name,:text)");
  //プレイスフォルダに値を設置する
  //bindValue ($パラメータID, $バインドする値 [, $PDOデータ型定数] )
  $stmt->bindValue('name',$name, PDO::PARAM_STR);
  $stmt->bindValue('text',$text, PDO::PARAM_STR);
  //実行
  $stmt->execute();
  //実行後にページリダイレクト
  header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'./finished.php');
}

//POST送信を受け取ったら処理を実行
if($_SERVER["REQUEST_METHOD"] === "POST"){
  addTodo($pdo);
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>PHPで掲示板アプリ</title>
  </head>
  <body>
    <h1>掲示板</h1>
    <h2>新規投稿</h2>
    <form action='./index.php' method='post'>
      name: <input type="text" name="name"><br />
      投稿内容:<br />
      <textarea name="text" cols="30" rows="10"></textarea><br />
      <input type="submit" name="send" value="投稿">
    </form>

    <h2>投稿内容一覧</h2>
    <ul>
      <?php foreach($todos as $todo): ?>
      <li>
        <p><?php echo 'No:'.h($todo->id) ?></p>
        <p><?php echo '名前:'.h($todo->name) ?></p>
        <p> <?php echo '投稿内容:'.h($todo->text) ?></p>
      </li>
      <?php endforeach ?>
    </ul>
  </body>
</html>