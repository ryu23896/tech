<html>
    <head>
        <meta charset "UTF-8">
              <title>テクアカ用電卓</title>
    </head>

    <body>

        <form method="post"  action="index.php">
            <input type="text" name="leftNumber" />
            <select name="operator">
                <option>+</option>
                <option>-</option>
                <option>*</option>
                <option>/</option>
            </select>
            <input type="text" name="rightNumber" />
            <input type="submit" value="計算する" />

        </form>

    </body>

    <?php
    $left = $_POST['leftNumber'];
    $ope = $_POST['operator'];
    $right = $_POST['rightNumber'];
    
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
     
    }else{
        print 'なんかへん';
    }
print $answer.'hoge';  
        
    ?>
</body>
</html>


























