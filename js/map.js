//****************************************
//成功関数
//****************************************
let map;

function mapsInit(position) {
  console.log(position,"成功")
  //lat=緯度、lon=経度 を取得
  const lat = position.coords.latitude;
  const lon = position.coords.longitude;
  let map=new Microsoft.Maps.Map("#myMap",{
    center:new Microsoft.Maps.Location(35.544183970713334, 134.81330869397715),
    // let infoWind=new Microsoft.Maps.InfoWindow();

    
  });

  let infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
    width: 160,
    height: 80,
    title: "豊岡駅",
    description: "豊岡市の中心の駅"
    // url:'img/toyookaeki.jpeg'
    // img.src='img/toyookaeki.jpeg'
  });
  infobox.setMap(map);
  // centerからスタートさせる↓
    let pushpin_station= new Microsoft.Maps.Pushpin(map.getCenter());
    // pushpinを表示させる↓
map.entities.push(pushpin_station);
  
// -------------------------------------
// 　　　　　豊小のpushpin↓
// --------------------------------------
let pushpin_toyosyou= new Microsoft.Maps.Pushpin({latitude:35.541965219092525, longitude:134.82205814002293},{color:"#ff9900",} 
// ,{title:'豊岡小学校',subTitle:"ひまわり学級",text:"A"} 
);

//  let infobox_toyosyou = new Microsoft.Maps.Infobox(map.getPushpin(), {
//   width: 160,
//   height: 80,
//   title: "豊岡小学校",
//   description: "ひまわり学級"
// });
// infobox_toyosyou.setMap(map);

// pushpinを表示させる↓
map.entities.push(pushpin_toyosyou);

// 豊小のpushpinクリックイベント↓
Microsoft.Maps.Events.addHandler(pushpin_toyosyou,"click",function(){
// alert("豊岡小学校　ひまわり学級");
// $("#toyosyou").hide();
// toggleを使うことで、クリックしたら表示＆隠すことができる↓
$(".jumbotron").toggle(1000);
        });


       
// --------------------------------------
// 　　　　　出石特別支援のpushpin↓
// --------------------------------------
let pushpin_izushi_school= new Microsoft.Maps.Pushpin({latitude:35.47786214757359, longitude:134.86872629492163},{color:"#ff9900",} );
// pushpinを表示させる↓
map.entities.push(pushpin_izushi_school);
// map.infobox(35.541965219092525, 134.82205814002293);

// 出石特別支援のpushpinクリックイベント↓
Microsoft.Maps.Events.addHandler(pushpin_izushi_school,"click",function(){
alert("出石特別支援学校");
// $(".izushi_tokubetsu").toggle(1000);
        });

// --------------------------------------
// 　　　　　精和園成人寮のpushpin↓
// --------------------------------------
let pushpin_seiwaen= new Microsoft.Maps.Pushpin({latitude:35.4714349, longitude:134.8419697},{color:"#ff0000",}  );
// pushpinを表示させる↓
map.entities.push(pushpin_seiwaen);

// 精和園成人寮のpushpinクリックイベント↓
Microsoft.Maps.Events.addHandler(pushpin_seiwaen,"click",function(){
alert("精和園成人寮");
// $(".seiwaen").toggle(1000);
        });


  // $(document).ready(function(){


  // })
};






  
  //Map表示
  // map = new Bmap("#myMap");
  // map.startMap(35.544183970713334, 134.81330869397715, "load", 20); 
  //The place is Bellevue.
  //Pinを追加
  // let pin = map.pin(35.544183970713334, 134.81330869397715, "#0066FF");
  // let pin_izushi_tokubetu = map.pin(35.47786214757359, 134.86872629492163, "#ff9900");
  // let pin_seiwaen = map.pin(35.4765884892285, 134.86928487545512, "#ff0000");
  // let pin_seiwaen2 = map.pin(35.4714349,134.8419697, "#ff0000");
  // let pin_toyosyou = map.pin(35.541965219092525, 134.82205814002293, "#ff9900");
  //Infoboxを追加
  // map.infobox(35.544183970713334, 134.81330869397715, "豊岡駅", "駅");
  // map.infobox(35.47786214757359, 134.86872629492163, "出石特別支援学校", "特別支援学校");
  // map.infobox(35.4765884892285, 134.86928487545512, "出石精和園児童寮", "生活支援施設");
  // map.infobox(35.4714349,134.8419697, "出石精和園成人寮", "生活支援施設");
  // map.infobox(35.541965219092525, 134.82205814002293, "豊岡小学校", "ひまわり学級(特別支援学級)");

  // map.Events.addHandler(pin_toyosyou,"click",function(){
  //   alert("click");
  //       });

// };


//****************************************
//失敗関数
//****************************************
function mapsError(error) {
  let e = "";
  if (error.code == 1) { //1＝位置情報取得が許可されてない（ブラウザの設定）
    e = "位置情報が許可されてません";
  }
  if (error.code == 2) { //2＝現在地を特定できない
    e = "現在位置を特定できません";
  }
  if (error.code == 3) { //3＝位置情報を取得する前にタイムアウトになった場合
    e = "位置情報を取得する前にタイムアウトになりました";
  }
  alert("エラー：" + e);
};

//****************************************
//オプション設定
//****************************************
const set = {
  enableHighAccuracy: true, //より高精度な位置を求める
  maximumAge: 20000, //最後の現在地情報取得が20秒以内であればその情報を再利用する設定
  timeout: 10000 //10秒以内に現在地情報を取得できなければ、処理を終了
};


//最初に実行する関数
function GetMap() {
  navigator.geolocation.getCurrentPosition(mapsInit, mapsError, set);
}