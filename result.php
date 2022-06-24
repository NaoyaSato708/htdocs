<!DOCTYPE html>
<meta charset="UTF-8">
<title>結果画面</title>
<h1>購入結果</h1>



<?php
$kokyaku = $_POST["a"];
$syohin = $_POST["b"];
$nedan = $_POST["c"];

$pdo = new PDO(
    "mysql:dbname=hello_world;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);
?>

<h3>購入履歴(最新10件表示）</h3>
<?php
if(!empty($_POST["a"]) && !empty($_POST["b"]) && !empty($_POST["c"])) {
$pdo = new PDO(
    "mysql:dbname=hello_world;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);

$pdo -> query("INSERT INTO
client_info
(client_name,product_name,price)
VALUES
('$kokyaku','$syohin','$nedan')");

echo 'New!:';

$n = $pdo -> query("SELECT * FROM client_info ORDER BY id  DESC LIMIT 10");
while ($i = $n -> fetch()) {
print "顧客名：{$i['client_name']}  商品名：{$i['product_name']}  値段：{$i['price']}円<br><hr>";}
}
else 
{
    echo 'エラー！:テキストボックスに値が入力されていません';
    echo '<br/>';
    echo '<br/>';
    echo 'New!:';
    $pdo = new PDO(
        "mysql:dbname=hello_world;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
    );
    $n = $pdo -> query("SELECT * FROM client_info ORDER BY id DESC LIMIT 10");
    while ($i = $n -> fetch()) {
    print "顧客名：{$i['client_name']}  商品名：{$i['product_name']}  値段：{$i['price']}円<br><hr>";}
}
?>

<section>
    <button onclick="location.href='purchase.php'">戻る</button>
</section>

<h3>顧客毎の合計購入金額</h3>
<?php

$custmerName = $pdo -> query("SELECT client_name, SUM(price) as sum_price FROM client_info GROUP BY client_name");
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