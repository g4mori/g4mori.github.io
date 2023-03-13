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
        
while(true) {
   $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(empty($rec["name"]) === true) {
        break;
    }
    // $o_name[] = $rec["name"]; //これがあると、プルダウンの内容が重複する
}
        
if(empty($o_name) === true) {
    print "※親カテゴリがありません。";
    print "<br><br><a href='index.php'>トップへ</a>";
    exit();
}

print "＜親カテゴリを選択して下さい。＞<br><br>";
print "<form action='k_menu_add_done.php' method='post'>";        
print "<select name='oya'>";
        
$max = count($o_name);
for($i = 0; $i < $max; $i++) {
print "<option value='".$o_name[$i]."'>".$o_name[$i]."</option>";
print "<br>";      
}
print "</select>";
print "<br>";
}
catch(Exception $e) {
    // exit('エラー：' . $e->getMessage());
    print "異常発生<br>";
    print "<a href='index.php'>トップへ</a>";
    exit();
}
?>
<br>

子カテゴリ追加<br>
<input type="text" name="name">
<input type="submit" value="OK"><br><br>
    
</body>
</html>