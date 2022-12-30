<?php

// セキュリティ対策↓
function h($str)
{
  // return＝引数
    return htmlspecialchars($str, ENT_QUOTES);
}
//1.  DB接続します
// insert.phpと同じ↓
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
// 処理のSQLを書く↓
// データ上にあるデータを取ってくるため、セキュリティ上問題ない
// $stmt = $pdo->prepare("SELECT * FROM gs_map_table;");
// 昨日付け足し↓
$stmt = $pdo->prepare("SELECT * FROM gs_map_table WHERE name LIKE '豊岡小学校'");


$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  // elseの中はSQL実行に成功した場合↓
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php

  // 1行とったらresultに格納し処理する↓
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // resuleのnameをviewに格納する　viewの中に名前が入ってくる↓
    // $view .=の.（ドット）を入れないと、一番最後に入れたもの（nameやemail）とかだけ出てきてしまう。
    // 追加してデータを出すためにドットを入れる
    // htmlspecialchars（セキュリティ対策）を実行するためにnameとemailをhで囲む
    // ブラウザで表示される時に、scriptタグをnameに入れてもjsが実行されず文字列で表示される↓
    $view .= '<p>'. $result['id'] . "/" .  h($result['name']) . "/" .   h($result['URL']) . "/" .  h($result['comment']). "/" . h($result['lat']) . "/" .   h($result['lng']) .'</p>';
    // 緯度経度を配列にプッシュする命令
    // Pタグ＝段落の意味をもっているためPタグで改行できる↑
    // 福島/aaaa/dddみたいにスラッシュで表示させるために . "/" . でそれぞれを結合させる
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- <style>div{padding: 10px;font-size:16px;}</style> -->
<style>
        html{
  height: 100%;
}
body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
}

.map_app{
  /* display: flex; */
  height: 100%;
}

#myMap{
  /* display: inline-block; */
  /* text-align: left; */
  width: 80%;
  height: 100%;
}
        div {
            padding: 10px;
            font-size: 16px;
        }

        .navbar-default{
  background-color: #008080;

}

       .jumbotron{
        display: none;
       }
    </style>

</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
  <!-- $view←ここに取得したnameが全部入ってくる -->
  
    <div class="container jumbotron"><?=$view ?></div>
</div>
<!-- Main[End] -->
    <!-- Main[End] -->
    <div class="map_app">
    <div id="view"></div>
  
    <div id="myMap"></div>
    
      <!-- jQuery&GoogleMapsAPI -->
  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=' async
    defer></script>
  <script src="js/BmapQuery.js"></script>
  <script src="js/map.js"></script>
</body>
</html>
