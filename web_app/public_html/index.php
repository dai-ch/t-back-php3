<?php
//絶対パスで指定する
require_once(__DIR__.'/common/DbManager.php');

//特殊な文字を記号のまま出力する ENT_QUOTESは''や""も変換対象にする
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function getposts($pdo)
{
    //SQL文を作成、格納
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY id ASC");
    //$stmtにSQL文を指定しfetchAllで実行
    $posts = $stmt->fetchAll();
    return $posts;
}
//todoListデータベースの接続情報を取し$postsへ格納
$posts = getposts($pdo);
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
    <form action='./finished.php' method='post'>
      name: <input type="text" name="name"><br />
      投稿内容:<br />
      <textarea name="text" cols="30" rows="10"></textarea><br />
      <input type="submit" name="send" value="投稿">
    </form>

    <h2>投稿内容一覧</h2>
    <ul>
      <?php foreach ($posts as $index => $post): ?>
      <li>

        <p><?php echo 'No:'.h($index + 1) ?></p>
        <p><?php echo '名前:'.h($post->name) ?></p>
        <p> <?php echo '投稿内容:'.h($post->text) ?></p><br>
        <form action='./edit.php' method="post">
          <input type="hidden" name="id" value="<?= h($post->id)?>">
          <input type="submit" value="編集" name="edit">
        </form>
        <form action='./delete.php' method="post">
          <input type="hidden" name="id" value="<?= h($post->id)?>">
          <input type="submit" value="削除" name="delete">
        </form>
      </li>
      <?php endforeach ?>
    </ul>
  </body>
</html>