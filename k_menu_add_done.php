
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
$o_name = $_POST['oya'];

try{

if(empty($name) === true) {
    print "カテゴリ名を入力して下さい。<br>";
    print "<a href='category.php'>戻る</a>";
    exit();
}

$dsn = "mysql:host=localhost;dbname=cms;charset=utf8";
$user = "cmsuser";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
$sql = "SELECT name FROM k_menu WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();

while(true) {
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(empty($rec["name"]) === true) {
        break;
    }
    $k_name[] = $rec["name"];
}

//入力で空でないかと重複が無いか確認後、親codeを（プライマリキー）を取得
if(empty($k_name) === false) { //入力が空でないか確認
if(in_array($name, $k_name) === true) { //重複がないか確認
    print "すでに登録されている項目です。<br>";
    print "<a href='category.php'>戻る</a>";
    exit();
}
}        
$sql = "SELECT code FROM o_menu WHERE name=?";
$stmt = $dbh -> prepare($sql);
$data[] = $o_name;
$stmt -> execute($data);
        
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        
$o_code = $rec["code"];
$data = array();


$sql = "INSERT INTO k_menu(name, o_code) VALUES(?,?)"; 
$stmt = $dbh -> prepare($sql);
$data[] = $name;
$data[] = $o_code;
$stmt -> execute($data);

$dbh = null;
        
}
catch(Exception $e) {
    // exit('エラー：' . $e->getMessage());
    print "只今障害が発生しております。<br><br>";
}

?>
    
子カテゴリを追加しました。<br><br>
<a href="category.php">戻る</a>
<br>
<a href="index.php">トップへ</a>


</body>
</html>