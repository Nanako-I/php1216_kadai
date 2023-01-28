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
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
// 処理のSQLを書く↓
// データ上にあるデータを取ってくるため、セキュリティ上問題ない
$stmt = $pdo->prepare("SELECT * FROM gs_map_table;");


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

        //学校長コード　 緯度経度を配列にプッシュする命令↓
        $lat = $result["lat"];
        $lng = $result["lng"];
        //$lat_lng=[];とし、グローバル変数に配列を入れること。ループの中で上書きが起きます。
        $lat_lng[] = array('lat'=> $lat, 'lng'=> $lng );

        $view .= '<p>';
        //GETデータ送信リンク作成
        $view .= '<a href="detail.php?id=' . $result['id'] . '">';
        $view .= $result['name'] . '：' . $result['URL'] . '：' . $result['comment'] . '：' . $result['lat'] . '：' .  $result['lng'];
        $view .= '</a>';

// 削除処理追加↓
    $view .= '<a href="delete.php?id=' . $result['id'] . '">';
        $view .= '[ 削除 ]';
        $view .= '</a>';
        $view .= '</p>';
  }
}
// JSに渡したいとき　 
// JSON_UNESCAPED_UNICODEはUnicode 文字をそのままの形式で扱います
$json = json_encode($lat_lng,JSON_UNESCAPED_UNICODE);
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
        /* display: none; */
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
  <!-- <script src="js/map.js"></script> -->
  <script>

// 学校長コード↓
let map;
function GetMap(){
  map = new Bmap("#myMap"); //MAPの準備(BmapQuery.js)
  const json = JSON.parse('<?= $json ?>'); //PHPのJSON文字列をJSのオブジェクト変数に変換！
  map.startMap(json[0].lat, json[0].lng, "load", 18); //MAP表示(BmapQuery.js)
  for (i = 0; i< json.length; i++){ //配列数 回す
    let pin = map.pin(json[i].lat-0, json[i].lng-0, "#ff0000"); //PINを立てる(BmapQuery.js)
    // BmapQuery.jsは以下サイトでサンプルを見た方が早いです。
    // https://mapapi.org/indexb.php
  };
}

</script>

</body>
</html>
