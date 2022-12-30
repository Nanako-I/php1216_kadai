<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
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

.navbar-default{
  background-color: #008080;

}
        div {
            padding: 10px;
            font-size: 16px;
        }

        .jumbotron{
      margin: 30px;
        }
    </style>
</head>

<body>
<!-- <body onload ="getLocation();"> -->
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <!-- insert.phpにフォームの内容をpostで送る↓ -->
    <form method="post" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>学校のコメントを入力</legend>
                <label>学校名：<input type="text" name="name"></label><br>
                <label>学校HP:<input type="URL" name="URL"></label><br>
                <label>緯度：<input type="text" name="lat" id="show_lat"></label><br>
                <label>経度：<input type="text" name="lng" id="show_lng"></label><br>
                <label><textArea name="comment" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->
  
    <div id="myMap"></div>
    
      <!-- jQuery&GoogleMapsAPI -->
  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=' async
    defer></script>
  <script src="js/BmapQuery.js"></script>
  <script src="js/map.js"></script>

  <script>
// myMap.addEventListener('click', function(){
//   alert('クリックされたよ');
// });

myMap.addEventListener('click', function(e){
  // getClickLatLng(e.latLng,myMap);

  // 座標を表示↓
  document.getElementById('show_lat').textContent = lat_lng.lat();
  // document.getElementById('show_lng').textContent = lat_lng.lng();
  alert("ok");
});

// function getClickLatLng(lat_lng, map){

// document.querySelector("#myMap").onclick=function getClickLatLng(lat_lng, myMap){
//   alert("ok");
//   document.getElementById('lat').textContent = lat_lng.lat();
// document.getElementById('lng').textContent = lat_lng.lng();

// };

    
  </script>
</body>

</html>
