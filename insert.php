


<?php
/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

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
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
    // エラーをキャッチしたら下記やってください↓
} catch (PDOException $e) {
  // exit＝処理を止めて処理の中身を書いてください↓
    exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成

// 1. SQL文を用意

$stmt = $pdo->prepare("INSERT INTO
gs_map_table (
    id, name, URL, comment, lat, lng, date
 ) VALUES(NULL, :name, :URL, :comment, :lat, :lng,  sysdate() )");

                        // -- NULLとすると自動的に連番でIDに入る 
                        // -- :nameや:URLは変数。$stmt->bindValueに入れる前に仮置きしてるだけ。$nameと同じ意味
                        

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
// PDOで処理してからnameに入れる（ユーザが書いたものが直接入ると超危ない！）
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':URL', $URL, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':lat', $lat, PDO::PARAM_INT);
$stmt->bindValue(':lng', $lng, PDO::PARAM_INT);
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


