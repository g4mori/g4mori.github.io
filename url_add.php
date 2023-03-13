<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>cms</title>
<link rel="stylesheet" href="setting/style2.css">
</head>
<body>
<?php 
try {

$dsn = "mysql:host=localhost;dbname=cms;charset=utf8";
$user = "cmsuser";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT name FROM k_menu WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();

$dbh = null;

while(true) {
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
  if(empty($rec["name"]) === true) {
  break;
  }
$k_menu[] = $rec["name"];
}

} catch(Exception $e) {
// exit('エラー：' . $e->getMessage());
print "只今障害が発生しております。<br><br>";
}
?>

<form action="url_add_done.php" method="post" >

  <label>カテゴリ</label><br>

  <select name='cate'>
  <?php foreach($k_menu as $key => $value) {;?>
  <option value='<?php print $value;?>'><?php print $value;?></option>
  <?php };?>
  </select>
  <br>
  
  <p>Youtube URLを入力してください。（共有URL、iframeにも対応）</p>
  <input name="text" type="text" >
  <input name="" type="submit" value="登録" >

</form>

</body>
</html>
