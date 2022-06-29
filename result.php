<!DOCTYPE html>
<meta charset="UTF-8">
<title>結果画面</title>
<h1>購入結果</h1>

<?php
$custmer = $_POST["custmerName"];
$products = $_POST["productsName"];
$value = $_POST["Price"];

$pdo = new PDO(
    "mysql:dbname=hello_world;host=localhost",
    "root",
    "",
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);
?>

<h3>購入履歴(最大10件表示)</h3>

<?php
session_start();

// POSTされたトークンを取得
$token = isset($_POST["token"]) ? $_POST["token"] : "";

// セッション変数のトークンを取得
$session_token = isset($_SESSION["token"]) ? $_SESSION["token"] : "";

// セッション変数のトークンを削除
unset($_SESSION["token"]);

// POSTされたトークンとセッション変数のトークンの比較
if ($token != "" && $token == $session_token) {
    // 登録画面送信データの登録を行う


    //変数名を変える。
    if (!empty($_POST["custmerName"]) && !empty($_POST["productsName"]) && !empty($_POST["Price"])) {
        $pdo = new PDO(
            "mysql:dbname=hello_world;host=localhost",
            "root",
            "",
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
        );


        $pdo->query("INSERT INTO
client_info
(client_name,product_name,price)
VALUES
('$custmer','$products','$value')");
    } else {
        echo '<span style="color:#FF0000;">エラー！:不正な登録処理です</span>';
        echo '<br/>';
        echo '<br/>';
    }

    echo '最終入力履歴：';

    $sql = $pdo->query("SELECT * FROM client_info ORDER BY id  DESC LIMIT 10");
    while ($list = $sql->fetch()) {
        print "顧客名：{$list['client_name']}  商品名：{$list['product_name']}  値段：{$list['price']}円<br><hr>";
    }
} else {
    echo '<span style="color:#FF0000;">エラー！:不正な登録処理です</span>';
    echo '<br/>';
    echo '<br/>';
    echo '最終入力履歴：';
    $pdo = new PDO(
        "mysql:dbname=hello_world;host=localhost",
        "root",
        "",
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
    );
    $sql = $pdo->query("SELECT * FROM client_info ORDER BY id DESC LIMIT 10");
    while ($list = $sql->fetch()) {
        print "顧客名：{$list['client_name']}  商品名：{$list['product_name']}  値段：{$list['price']}円<br><hr>";
    }
}

?>

<section>
    <button onclick="location.href='purchase.php'">戻る</button>
</section>

<h3>顧客毎の合計購入金額</h3>
<?php

$custmerName = $pdo->query("SELECT client_name, SUM(price) as sum_price FROM client_info GROUP BY client_name");
foreach ($custmerName as $row) {
    echo '顧客名：';
    echo $row['client_name'];
    echo '<br>';
    echo '合計金額：';
    echo $row['sum_price'];
    echo '円';
    echo '<br>';
}
/*
echo '顧客名：佐藤尚哉<br>';
$e = $pdo -> query("SELECT * FROM client_info WHERE client_name = '佐藤尚哉'");
while ($f = $e -> fetch()) {
print "商品名：{$f['product_name']}  値段：{$f['price']}円<br>";}
$g = $pdo -> query("SELECT SUM(price) as sum_price FROM client_info WHERE client_name = '佐藤尚哉'");
while ($h = $g -> fetch()) {
print "合計金額：{$h['sum_price']}円<br><hr><br>";}

echo '顧客名：藤原花子<br>';
$e = $pdo -> query("SELECT * FROM client_info WHERE client_name = '藤原花子'");
while ($f = $e -> fetch()) {
print "商品名：{$f['product_name']}  値段：{$f['price']}円<br>";}
$g = $pdo -> query("SELECT SUM(price) as sum_price FROM client_info WHERE client_name = '藤原花子'");
while ($h = $g -> fetch()) {
print "合計金額：{$h['sum_price']}円<br><hr><br>";}


echo '顧客名：山田太郎<br>';
$e = $pdo -> query("SELECT * FROM client_info WHERE client_name = '山田太郎'");
while ($f = $e -> fetch()) {
print "商品名：{$f['product_name']}  値段：{$f['price']}円<br>";}
$g = $pdo -> query("SELECT SUM(price) as sum_price FROM client_info WHERE client_name = '山田太郎'");
while ($h = $g -> fetch()) {
print "合計金額：{$h['sum_price']}円<br><hr><br>";}

echo '顧客名：加藤浩次<br>';
$e = $pdo -> query("SELECT * FROM client_info WHERE client_name = '加藤浩次'");
while ($f = $e -> fetch()) {
print "商品名：{$f['product_name']}  値段：{$f['price']}円<br>";}
$g = $pdo -> query("SELECT SUM(price) as sum_price FROM client_info WHERE client_name = '加藤浩次'");
while ($h = $g -> fetch()) {
print "合計金額：{$h['sum_price']}円<br><hr><br>";}
*/
?>