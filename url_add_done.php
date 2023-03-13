<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>cms</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php

$cate = $_POST["cate"];
$url = $_POST["text"];

$youtube = $youtubedata = null;

if(empty($url) === true) {
	print "URLを入力して下さい。<br>";
	print "<a href='index.php'>戻る</a>";
	exit();
}

if (isset($_POST["text"]) == true)
{
	/** 入力内容を取得 */
	$youtubedata = $youtube_url = $youtube = $_POST["text"];

	/** ＨＴＭＬコードをエンティ */
	$youtubedata = htmlspecialchars($youtubedata, ENT_QUOTES);

	if (strpos($youtube_url, "iframe") != true)	/* フレームでない ? */
	{
		if (strpos($youtube_url, "watch") != false)	/* ページURL ? */
		{
			/** コード変換 */
			$youtube_url = substr($youtube_url, (strpos($youtube_url, "=")+1));
		}
		else
		{
			/** 短縮URL用に変換 */
			$youtube_url = substr($youtube_url, (strpos($youtube_url, "youtu.be/")+9));
		}
	}
}


try {

    
$dsn = "mysql:host=localhost;dbname=cms;charset=utf8";
$user = "cmsuser";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT name FROM k_menu WHERE name=?";
$stmt = $dbh -> prepare($sql);
$data[] = $cate;
$stmt -> execute($data);
        
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        
$cate1 = $rec["name"];
$data = array();

$sql = "INSERT INTO youtube_url(name, category) VALUES(?,?)";
$stmt = $dbh -> prepare($sql);
$data[] = $youtube_url;
$data[] = $cate1;
$stmt -> execute($data);

$dbh = null;
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
	//  exit('エラー：' . $e->getMessage());
}
?>
 
登録しました。

<br><br>
<a href="index.php">トップへ</a>
    
</body>
</html>