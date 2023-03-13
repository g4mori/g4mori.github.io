
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CMS</title>
<link rel="stylesheet" href="style2.css">
</head>
    
<body>
    
<?php
    try {
    
$dsn = "mysql:host=localhost;dbname=cms;charset=utf8";
$user = "cmsuser";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT name FROM o_menu WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();
    
$dbh = null;
        
print "＜カテゴリ一覧＞<br><br>";
    
while(true) {
   $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(empty($rec["name"]) === true) {
        break;
    }
    $o_name[] = $rec["name"];
    print "・".$rec["name"]."<br>";
}
if(empty($o_name) === true) {
    print "登録がありません。";
}
}
catch(Exception $e) {
    // exit('エラー：' . $e->getMessage());
    print "サーバーに異常が発生しました。<br>";
    print "<a href='index.php'>トップへ</a>";
    exit();
}
?>
<br>
<br>
    
<form action="o_menu_add_done.php" method="post">

<input type="text" name="name">
<input type="submit" value="OK">
</form>    
    
</body>
</html>