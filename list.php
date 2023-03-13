<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>動画一覧</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

<aside><?php include ('side.php'); ?></aside>

<main>
<?php
try {
  
$cate = $_GET["cate"];


//DB接続
$dsn = "mysql:host=localhost;dbname=cms;charset=utf8";
$user = "cmsuser";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
//クエリ実行
//クエリ内容：ブログテーブルからカテゴリーと等しいタイトルを取得
$sql = "SELECT name FROM youtube_url WHERE category=?";
$stmt = $dbh -> prepare($sql);
$data[] = $cate;
$stmt -> execute($data); //sql文が実行の実行と$dateがstsmに代入される
$data = array(); //$dataを空にする
        
while(true) { //Tの時T
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC); //カラム名のみの配列
    if(empty($rec["name"]) === true) {//titleが空である場合
        break;
    }
    $name[] = $rec["name"]; 
}
          
if(isset($name) === true) { //null以外の何かが入っている場合


$sql = "SELECT * FROM youtube_url WHERE category=? ORDER BY code DESC ";
$stmt = $dbh -> prepare($sql);
$data[] = $cate;
$stmt -> execute($data);

$dbh = null;

while(true) {
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(empty($rec["name"]) === true) {
    break;
    }
    $url[] = $rec["name"];
    /** youtube 表示状態に変換 */

    print "<p><iframe width=\"350\" height=\"200\" src=\"https://www.youtube.com/embed/".$rec["name"]."\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe></p>";
    }
    if(empty($url) === true) {
    print "なし";
    }    
} else {
      print "<br><br>";
      print "動画がありません。";
}

}catch(Exception $e) {
      print "異常";
      exit();
//  exit('エラー：' . $e->getMessage());
}
  
?>
</main>
</div>
</body>
</html>