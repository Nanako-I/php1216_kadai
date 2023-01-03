<?php

//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更
//1. POSTデータ取得
$name   = $_POST['name'];
$URL = $_POST['URL'];
$comment = $_POST['comment'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$id = $_POST['id'];


//2. DB接続します
//*** function化する！  *****************
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE gs_map_table SET name = :name, URL = :URL, comment = :comment, lat = :lat, lng = :lng, date = sysdate() WHERE id = :id;');

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':URL', $URL, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
// 緯度経度は数値だけどphpのdecimalの型にはめるためPARAM_INTではなくPARAM_STRと指定↓
$stmt->bindValue(':lat', $lat, PDO::PARAM_STR);
$stmt->bindValue(':lng', $lng, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
  //*** function化する！******\
  $error = $stmt->errorInfo();
  exit('SQLError:' . print_r($error, true));
} else {
  //*** function化する！*****************
  header('Location: select.php');
  exit();
}