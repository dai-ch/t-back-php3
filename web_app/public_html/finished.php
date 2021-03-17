<?php
require_once(__DIR__.'/common/DbManager.php');

//POST送信を受け取ったら処理を実行
if($_SERVER["REQUEST_METHOD"] === "POST"){
  addPost($pdo);

  //実行後にページリダイレクト
  header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'./index.php');
}

function addPost($pdo){
  //HTTPヘッダーから取得。trimで空白を削除
  //「HTTPヘッダー」は、データ本体の前に送られてくる、各種の状態を示す情報が入れられている部分。
  $name = trim(filter_input(INPUT_POST,'name'));
  $text = trim(filter_input(INPUT_POST,'text'));

  if($name === '' || $text === '' ){
    return;
  }
  //DBに値を追加する準備(:〇〇はプレイスフォルダを表す。パラメータの置き場所)
  $stmt = $pdo->prepare("INSERT INTO posts(name,text) VALUES (:name,:text)");
  //プレイスフォルダに値を設置する
  //bindValue ($パラメータID, $バインドする値 [, $PDOデータ型定数] )
  $stmt->bindValue('name',$name, PDO::PARAM_STR);
  $stmt->bindValue('text',$text, PDO::PARAM_STR);
  //実行
  $stmt->execute();

}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Document</title>
  </head>
  <body>


    <h2>投稿が完了しました。</h2>

    <button><a href="./index.php">投稿一覧へ戻る</a></button>

  </body>
</html>