


<?php

//1. POSTデータ取得
$name = $_POST['name'];
$URL = $_POST['URL'];
$comment = $_POST['comment'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

//2. DB接続します※基本コピペ！！
// try=データベースに接続してください
try {
    //ID:'root', Password: xamppは 空白 ''
    // データベースネーム＝gs_db・デフォルトのID＝root・デフォルトのPW＝空白
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', 'root');
    // エラーをキャッチしたら下記やってください↓
} catch (PDOException $e) {
  // exit＝処理を止めて処理の中身を書いてください↓
    exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成
// $pdo = db_conn();
// 1. SQL文を用意

$stmt = $pdo->prepare("INSERT INTO

gs_map_table (
  name, URL, comment, lat, lng, date
 ) VALUES(:name, :URL, :comment, :lat, :lng,  sysdate() )");

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
// PDOで処理してからnameに入れる（ユーザが書いたものが直接入ると超危ない！）
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':URL', $URL, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
// 緯度経度は数値だけどphpのdecimalの型にはめるためPARAM_INTではなくPARAM_STRと指定↓
$stmt->bindValue(':lat', $lat, PDO::PARAM_STR);
$stmt->bindValue(':lng', $lng, PDO::PARAM_STR);

//  3. 実行
// execute＝実行してください！
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('ErrorMessage:'.$error[2]);
} else {
    //５．index.phpへリダイレクト
    header('Location: index.php');
}
?>


