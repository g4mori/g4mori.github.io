<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>cms</title>
<link rel="stylesheet" href="style.css">
</head>
    
<body>
    
<?php

    $name = $_POST['name'];

    try{

if(empty($name) === true) {
    print "カテゴリ名を入力して下さい。<br>";
    print "<a href='category_add.php'>戻る</a>";
    exit();
}

$dsn = "mysql:host=localhost;dbname=cms;charset=utf8";
$user = "cmsuser";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
$sql = "SELECT name FROM o_menu WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();
        
while(true) {
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(empty($rec["name"]) === true) {
        break;
    }
    $o_name[] = $rec["name"];
}

if(empty($o_name) === false) {
if(in_array($name, $o_name) === true) {
    print "すでに登録されている項目です。<br>";
    print "<a href='category.php'>戻る</a>";
    exit();
}
}
   
$sql = "INSERT INTO o_menu(name) VALUES(?)";
$stmt = $dbh -> prepare($sql);
$data[] = $name;
$stmt -> execute($data);
    
$dbh = null;
        
}
catch(Exception $e) {
    // exit('エラー：' . $e->getMessage());
    print "サーバーに異常が発生しました。<br>";
    print "<a href='index.php'>トップへ</a>";
}
?>
    
親カテゴリを追加しました。<br><br>
<a href="category.php">戻る</a>
<br>
<a href="index.php">トップへ</a>

</body>
</html>