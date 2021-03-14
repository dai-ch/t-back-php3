<h2>投稿が完了しました。</h2>

<input type="button" value="投稿一覧へ戻る" action="index.php">


CREATE TABLE todos(
  id INT not null AUTO_INCREMENT,
  name VARCHAR(255),
  text TEXT,
  PRIMARY KEY (id)
);
