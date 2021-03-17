<?php
require_once(__DIR__.'/common/DbManager.php');

//POST送信を受け取ったら処理を実行
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    updatePost($pdo);
}

function updatePost($pdo)
{
    $id = filter_input(INPUT_POST, 'id');
    $name = trim(filter_input(INPUT_POST, 'name'));
    $text = trim(filter_input(INPUT_POST, 'text'));

    $stmt = $pdo->prepare("UPDATE posts SET name = :name, text = :text WHERE id = :id");

    //bindValue ($パラメータID, $バインドする値 [, $PDOデータ型定数] )
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);
    $stmt->bindValue('text', $text, PDO::PARAM_STR);
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

    <h2>編集が完了しました。</h2>
    <button onclick="location.href='./index.php'">投稿一覧へ戻る</button>

  </body>
</html>