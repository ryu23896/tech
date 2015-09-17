<html>
<head><title>テクアカ用練習掲示板</title></head>
<body>

<p>テクアカ用練習掲示板</p>

<form method="POST" action="<?php print($_SERVER['PHP_SELF']) ?>">
<input type="text" name="user_name"><br><br>
<textarea name="message" rows="8" cols="40">
</textarea><br><br>
<input type="submit" name="btn1" value="投稿">
</form>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    writeData();
}

readData();

function readData(){
    $bbs_file = 'bbs.txt';

    $fp = fopen($bbs_file, 'rb');
//ここから
    if ($fp){
        if (flock($fp, LOCK_SH)){
            while (!feof($fp)) {
                $buffer = fgets($fp);
                print($buffer);
            }

            flock($fp, LOCK_UN);
        }else{
            print('ファイルロックに失敗しました');
        }
    }
//ここまで（分からない）
    fclose($fp);
}

function writeData(){
$name = $_POST['user_name'];
$message = $_POST['message'];
$message = nl2br($message);

$data = "<hr>\r\n";
$data = $data."<p>投稿者:".$user_name."</p>\r\n";
$data = $data."<p>内容:</p>\r\n";
$data = $data."<p>".$message."</p>\r\n";

$bbs_file = 'bbs.txt';

$fp = fopen($bbs_file, 'ab');
//ここから
    if ($fp){
        if (flock($fp, LOCK_EX)){
            if (fwrite($fp,  $data) === FALSE){
                print('ファイル書き込みに失敗しました');
            }

            flock($fp, LOCK_UN);
        }else{
            print('ファイルロックに失敗しました');
        }
    }
//ここまで（分からない）
    fclose($fp);
}

?>
</body>
</html>