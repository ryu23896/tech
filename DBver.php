<html>
<head><title>テクアカ用練習掲示板</title></head>
<body>

<p>テクアカ用練習掲示板</p>

<form method="POST" action="DBver.php">
<input type="text" name="user"><br><br>
    <textarea name="message" rows="8" cols="40">
    </textarea><br><br>
<input type="submit" name="btn1" value="投稿">
</form>

<?php


$user = $_POST['user'];
$message = $_POST['message'];


if($_SERVER['REQUEST_METHOD'] == "POST") {
   writeData();   
}

readData();


function readData(){
require_once 'DbManager.php';


try {
    $db = getDb();
    $stt = $db->prepare('select * from bbs_data order by no desc');
    $stt->execute();
        while($row = $stt->fetch(PDO::FETCH_ASSOC)) {
        print "<p>\n";
        print '<strong>[No.' . $row['no'] . ']' . '名前:' . htmlspecialchars($row['user'], ENT_QUOTES) . "</strong><br>\n";
        print "<br>\n";
        print nl2br(htmlspecialchars($row['message'],ENT_QUOTES));
        print "</p>\n";
        
        }
        $db = NULL;
} catch (Exception $e) {
    die("エラーメッセージ：{&e->getMessage()}");
}
}

function writeData(){
    require_once 'DbManager.php';

try {
   $db = getDb();
      
   $stt = $db->prepare('INSERT INTO bbs_data(user,message) VALUES (:user, :message)');
      
   $stt->bindValue(':user', $_POST['user']);
   $stt->bindValue(':message', $_POST['message']);   
   $stt->execute();
   $db = NULL; 
} catch (Exception $e) {
   die("エラーメッセージ:{$e->getMessage()}");
   }
}



