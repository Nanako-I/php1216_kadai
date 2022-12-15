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
                <label><textArea name="comment" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
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
