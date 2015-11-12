<html>
    <head><title>テクアカ用練習掲示板</title></head>
    <body>

        <p>テクアカ用練習掲示板</p>

        <form method="POST" action="DBver.php">
            <input type="text" name="user"><br><br>
            <textarea name="message" rows="8" cols="40"></textarea><br><br>
            <input type="submit" name="btn1" value="投稿">
        </form>

        <?php
        require_once 'DbManager.php';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (empty($_POST['user']) or empty($_POST['message'])) {
                print '文字を入力してください';
            } else {
                if (isset($_POST['user']) and isset($_POST['message'])) {
                    $user = $_POST['user'];
                    $message = $_POST['message'];
                    writeData();
                   
                } else {
                    print '文字を入力してください';
                }
            }
            
        }

        readData();

        function readData() {


            try {
                $db = getDb();
                $stt = $db->prepare('select * from bbs_data order by no desc');
                $stt->execute();
                while ($row = $stt->fetch(PDO::FETCH_ASSOC)) {
                    print "<p>\n";
                    print '<strong>[No.' . $row['no'] . ']' . '名前:' . htmlspecialchars($row['user'], ENT_QUOTES) . "</strong><br>\n";
                    print "<br>\n";
                    print nl2br(htmlspecialchars($row['message'], ENT_QUOTES));
                    print "</p>\n";
                }
                $db = NULL;
            } catch (Exception $e) {
                die("エラーメッセージ：{$e->getMessage()}");
            }
        }

        function writeData() {
            global $user;
            global $message;


            try {
                $db = getDb();

                $stt = $db->prepare('INSERT INTO bbs_data(user,message) VALUES (:user, :message)');

                $stt->bindValue(':user', $user);
                $stt->bindValue(':message', $message);
                $stt->execute();
                $db = NULL;
            } catch (Exception $e) {
                die("エラーメッセージ:{$e->getMessage()}");
            }
        }
        