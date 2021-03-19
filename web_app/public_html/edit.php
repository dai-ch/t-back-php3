<?php
//絶対パスで指定する
require_once(__DIR__.'/common/DbManager.php');

//POST送信を受け取ったら処理を実行
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = filter_input(INPUT_POST, 'id');
    if (empty($id)) {
        return;
    }

    //DBのデータを値を削除する準備(:〇〇はプレイスフォルダを表す。パラメータの置き場所)
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    //プレイスフォルダに値を設置する
    //bindValue ($パラメータID, $バインドする値 [, $PDOデータ型定数] )
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
    //実行
    $stmt->execute();

    //
    $update = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <h2>編集ページ</h2>
    <form action='./update.php' method='post'>
      名前: <input type="text" name="name" value="<?php echo $update['name']?>"><br />
      投稿内容:<br />
      <textarea name="text" cols="30" rows="10"><?php echo $update['text']?></textarea><br />
      <input type="hidden" name="id" value="<?php echo $update['id'] ?>">
      <input type="submit" name="send" value="更新">
    </form>
    <button onclick="location.href='index.php'">戻る</button>
  </body>
</html>