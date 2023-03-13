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
<aside>
    <h2>カテゴリー</h2>


<?php
try{

$dsn = "mysql:host=localhost;dbname=cms;charset=utf8";
$user = "cmsuser";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$sql = "SELECT name, code FROM o_menu WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();


    
while(true) {
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(empty($rec["name"]) === true) {
        break;
    }
    $o_name[] = $rec["name"];
    $o_code[] = $rec["code"];
}
  
if(isset($o_name) === true) {
$max = count($o_name);
 
for($i = 0; $i < $max; $i++) {
    $n = $i+1;
    print $o_name[$i];

    $code = $o_code[$i];
        
    $sql = "SELECT name FROM k_menu WHERE o_code=?";
    $stmt = $dbh -> prepare($sql);
    $data[] = $code;
    $stmt -> execute($data);
        
    print "<ul class='side_ul'>";

    while(true) {
        $rec2 = $stmt -> fetch(PDO::FETCH_ASSOC);
            if(empty($rec2["name"]) === false) {
            print "<a href='list.php?cate=".$rec2['name']."'>";
            print "<li>".$rec2['name']."</li>";
            print "</a>";
            } else {
            print "</ul>";
            $data = array();
            break;
            }
        }
    }
}
    print "<a href='index.php'>トップへ</a>";
    $dbh = null;
}   
catch(Exception $e) {
    print "異常";
    exit();
}
?>
</aside>
<main>

</main>
</div>
</body>
</html>