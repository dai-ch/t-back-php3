<?php
require_once(__DIR__.'/common/DbManager.php');

//POST送信を受け取ったら処理を実行
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    deletePost($pdo);
    //実行後にページリダイレクト
    // header('Location: http://'.$_SERVER['HTTP_HOST'].    dirname($_SERVER['PHP_SELF']).'./index.php');
}

function deletePost($pdo)
{
    //HTTPヘッダーから取得
    //「HTTPヘッダー」は、データ本体の前に送られてくる、各種の状態を示す情報が入れられている部分。
    $id = filter_input(INPUT_POST, 'id');

    if (empty($id)) {
        return;
    }
    //DBのデータを値を削除する準備(:〇〇はプレイスフォルダを表す。パラメータの置き場所)
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    //プレイスフォルダに値を設置する
    //bindValue ($パラメータID, $バインドする値 [, $PDOデータ型定数] )
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
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
    <button onclick="location.href='./index.php'">投稿一覧へ戻る</button>

  </body>
</html>