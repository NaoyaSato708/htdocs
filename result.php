<!DOCTYPE html>
<meta charset="UTF-8">
<title>結果画面</title>
<h1>購入結果</h1>
<section>
    <h2>登録完了</h2>
    <button onclick="location.href='purchase.php'">戻る</button>
</section>


<?php
$a = $_POST["a"];
$b = $_POST["b"];
$c = $_POST["c"];

$pdo = new PDO(
    "mysql:dbname=hello_world;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);
?>

<?php//顧客毎の購入履歴を求める?>
<h3>顧客別購入商品一覧</h3>
<?php
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
?>

<h3>購入履歴</h3>
<?php
if(!empty($_POST["a"]) && !empty($_POST["b"]) && !empty($_POST["c"])) {
$pdo = new PDO(
    "mysql:dbname=hello_world;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);
/*
if ($pdo) {
    echo "DB接続OK<br>";
} else {
    echo "DB接続NG<br>";
}
*/
$pdo -> query("INSERT INTO
client_info
(client_name,product_name,price)
VALUES
('$a','$b','$c')");
/*
if ($pdo) {
    echo "登録成功<br>";
} else {
    echo "登録失敗<br>";
}
*/
?>

<?php
$n = $pdo -> query("SELECT * FROM client_info ORDER BY id DESC");
while ($i = $n -> fetch()) {
print "顧客名：{$i['client_name']}  商品名：{$i['product_name']}  値段：{$i['price']}円<br><hr>";}
}
else 
{
    $pdo = new PDO(
        "mysql:dbname=hello_world;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
    );
    /*
    if ($pdo) {
        echo "DB接続OK<br>";
    } else {
        echo "DB接続NG<br>";
    }
    */
    $n = $pdo -> query("SELECT * FROM client_info ORDER BY id DESC");
    while ($i = $n -> fetch()) {
    print "顧客名：{$i['client_name']}  商品名：{$i['product_name']}  値段：{$i['price']}円<br><hr>";}
}
?>