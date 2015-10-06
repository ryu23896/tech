<?php
error_reporting(-1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
// 右辺と左辺の値が正しいかチェック
    if (is_numeric($_POST['leftNumber']) && is_numeric($_POST['rightNumber'])) {
        $left = $_POST['leftNumber'];
        $right = $_POST['rightNumber'];
    } else {
        print '<center>文字は入力出来ません！</center>';
    }

// 演算子が正しいかチェック
    if ($_POST['operator'] =='+' or $_POST['operator'] == '-' or $_POST['operator'] == '*' or $_POST['operator'] == '/') {
        $ope = $_POST['operator'];    
    } else {
        print '<center>演算子が正しくありません</center>';
    }
    
    
//　演算子に合わせて計算
    switch ($ope) {
        case '+':
            $answer = $left + $right;
            break;
        case '-':
            $answer = $left - $right;
            break;
        case '*':
            $answer = $left * $right;
            break;
        case '/':
            $answer = $left / $right;
            break;
        default :
            print '???';
            break;
    }

    print "<center>{$left}  {$ope}  {$right}  は {$answer}  です<center>";
}

?>
<html>
    <head>
        <meta charset "UTF-8">
              <title>テクアカ用電卓</title>
    </head>

    <body>
 
    <center><H1><form method="post"  action="bunri.php">
            <input type="text" name="leftNumber" />
            <select name="operator">
                <option>+</option>
                <option>-</option>
                <option>*</option>
                <option>/</option>
            </select>
            <input type="text" name="rightNumber" />
            <input type="submit" value="計算する" />

            </form><center></H1>

        
    </body>



</html>


























