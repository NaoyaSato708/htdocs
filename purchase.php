<?php
session_start();

// 二重送信防止用トークンの発行
$token = uniqid('', true);;

//トークンをセッション変数にセット
$_SESSION['token'] = $token;
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<title>購入情報入力画面</title>
<h1>購入情報入力</h1>
<section>
    <form action="result.php" method="post">
        顧客名: <input type="text" pattern="^[\D][\S]+$" name="a"><br>
        商品名: <input type="text" pattern="^[\D][\S]+$" name="b"><br>
        値段: <input type="number" max="99999999" step="1" name="c"><br>
        <input type="hidden" name="token" value="<?php echo $token;?>">
        <button type="submit">登録</button>
    </form>
</section>