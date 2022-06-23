<?php
	/*
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	header('Location: '.$uri.'/dashboard/');
	exit;

	Something is wrong with the XAMPP installation :-(
	*/
?>


<html>
<head>
<title>test</title>
</head>
<body>

<?php

$link = new mysqli('localhost','root','','hello_world');
// 接続状況をチェック
/*
if (mysqli_connect_errno()) {
    die("データベースに接続できません:" . mysqli_connect_error() . "\n");
}
echo "データベースの接続に成功しました。\n";

$db_selected = $link->select_db('hello_world');
if (!$db_selected){
    die('データベース選択失敗です。'.mysqli_error());
}
print('<p>データベース選択に成功しました。</p>');

 mysqli_set_charset($link,'utf8');
 */

$result = $link->query('SELECT value FROM test');
if (!$result) {
    die('クエリーが失敗しました。'.mysqli_error());
}

 while ($row = mysqli_fetch_assoc($result)) {
     print('<p>');
     print($row['value']);
     printf("\n");
     print('</p>');
 }
//DBにある情報をブラウザに表示させる。

// 接続を閉じる
mysqli_close($link);
?>
</body>
</html>