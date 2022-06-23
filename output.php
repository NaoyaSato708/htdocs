<!DOCTYPE html>
<meta charset="UTF-8">
<title>結果画面</title>
<h1>何か入力してDBに登録</h1>
<section>
    <h2>登録完了</h2>
    <button onclick="location.href='top.php'">戻る</button>
</section>


<?php
$a = $_POST["a"];
$pdo = new PDO(
    "mysql:dbname=hello_world;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);
if ($pdo) {
    echo "DB接続OK<br>";
} else {
    echo "DB接続NG<br>";
}

$pdo -> query("INSERT INTO
test
(value)
VALUES
('$a')");

if ($pdo) {
    echo "登録成功<br>";
} else {
    echo "登録失敗<br>";
}

$n = $pdo -> query("SELECT * FROM test ORDER BY id DESC");
while ($i = $n -> fetch()) {
print "{$i['value']}<br>";}

?>