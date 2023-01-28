<?php

$id = $_GET['id'];

//2. DB接続します
//*** function化する！  *****************
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', 'root');
  } catch (PDOException $e) {
    exit('DBConnectError'.$e->getMessage());
  }
// require_once('funcs.php');
// $pdo = db_conn();
//３．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM gs_map_table WHERE id = :id');
// WHERE id = :id'を入れないと全部消えてしまう！！↑

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_INTなので注意

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