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
$stmt = $pdo->prepare("SELECT * FROM gs_map_table;");
// 昨日付け足し↓
// $stmt = $pdo->prepare("SELECT * FROM gs_map_table WHERE name LIKE '豊岡小学校'");


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

        //GETデータ送信リンク作成

        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $result['id'] . '">';
        $view .= $result['name'] . '：' . $result['URL'] . '：' . $result['comment'] . '：' . $result['lat'] . '：' .  $result['lng'];
        $view .= '</a>';


        // 緯度経度を配列にプッシュする命令↓
        $lat_lng = array('lat'=> $result['lat'], 'lng'=> $result['lng']);

        // $keys = array_keys($lat_lng);
        // var_dump($keys);

        // 配列名が「$lat_lng」なので、値を取得するときは「$lat_lng[]」と書く↓
        // 取得したい値のキーを[]の中に書く
        $lat = $lat_lng["lat"];
        $lng = $lat_lng["lng"];
        var_dump($lat,$lng);


        // var_dump($lat_lng);

// 削除処理追加↓
    $view .= '<a href="delete.php?id=' . $result['id'] . '">';
        $view .= '[ 削除 ]';
        $view .= '</a>';
        $view .= '</p>';
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
  <!-- <script src="js/map.js"></script> -->
  <script>

function GetMap(){
//------------------------------------------------------------------------
//1. Instance
//------------------------------------------------------------------------
const map = new Bmap("#myMap");

//---------------------------------------------------

map.startMap(35.544183970713334, 134.81330869397715, "load", 10);

function getCenter(){
  let center = myMap.getCenter
};

var pins = new Microsoft.Maps.EntityCollection();
  // var i ; var confirmed = 0;
for (i = 0; i< 'lat_lng'.length; i++){

  // console.log($lat_lng);
  var position = new Microsoft.Maps.Location('lat_lng');
  var pin = new Microsoft.Maps.Pushpin(position);
  pins.push(pin);
  map.entities.push(pins);
};
}

//   var pins = new Microsoft.Maps.EntityCollection();
//   // var i ; var confirmed = 0;
// for (i = 0; i< $_GET['lat_lng'].length; i++){
//   var_dump($lat_lng);
//   var position = new Microsoft.Maps.Location($_GET['lat_lng']);
//   var pin = new Microsoft.Maps.Pushpin(position);
//   pins.push(pin);
//   map.entities.push(pins);
// };
// }
</script>

</body>
</html>
