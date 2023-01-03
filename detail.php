<?php

/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
 */
$id = $_GET['id'];
// echo $id;


try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}
// require_once('funcs.php');
// $pdo = db_conn();
//３．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_map_table WHERE id = :id');
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
  // 1件取得したら終了なので、while文にしなくてよい↓
//  （ whileは条件を満たす間、決まった処理を実行し続ける）
  $result = $stmt->fetch();

}

?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

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
    <form method="post" action="update.php">
        <div class="jumbotron">
            <fieldset>
            <legend>学校のコメントを入力</legend>
                <label>学校名：<input type="text" name="name" value="<?= $result['name']?>"></label><br>
                <label>学校HP:<input type="URL" name="URL" value="<?= $result['URL']?>"></label><br>
                <label>緯度：<input type="text" name="lat"  placeholder="緯度が自動入力" id="show_lat" value="<?= $result['lat']?>"></label><br>
                <label>経度：<input type="text" name="lng" id="show_lng" placeholder="経度が自動入力" value="<?= $result['lng']?>"></label><br>
                <label><textArea name="comment" rows="4" cols="40"><?= $result['comment']?></textArea></label><br>
                <input type="hidden" name="id" value="<?= $result['id']?>">
                <input type="submit" value="修正"> 
            <!-- <legend>学校のコメントを入力</legend>
                <label>学校名：<input type="text" name="name"></label><br>
                <label>学校HP:<input type="URL" name="URL"></label><br>
                <label>緯度：<input type="text" name="lat"  placeholder="緯度が自動入力" id="show_lat" ></label><br>
                <label>経度：<input type="text" name="lng" id="show_lng" placeholder="経度が自動入力"></label><br>
                <label><textArea name="comment" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="送信"> -->
              
            
                  </fieldset>
        </div>
    </form>
       

    </body>

</html>