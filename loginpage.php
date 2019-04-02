<?php

header('Content-Type: text/html; charset=UTF-8');

//データベースへ接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql="CREATE TABLE IF NOT EXISTS userData"
."("
."id INT PRIMARY KEY AUTO_INCREMENT,"
."name varchar(20),"
."pass varchar(100)"
.");";
$stmt=$pdo->query($sql);



$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "ユーザー名";  // ユーザー名
$db['pass'] = "パスワード";  // ユーザー名のパスワード
$db['dbname'] = "データベース名";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["username"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザー名が未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql2    = 'SELECT * FROM userData';
        $results = $pdo ->query($sql2);
        $data    = $results->fetchAll();
        foreach($data as $row){
          
          if($row['name']==$username){
            if($row['pass'] == $password){
                $to = $_POST['mail'];
                $title = 'メール認証';
                $content = "http://tt-566.99sv-coco.com/mission5.php";
                mb_send_mail($to, $title, $content);
                $errorMessage = '受信したメールからログインしてください。'; 
            }
            else{
                $errorMessage = 'ユーザー名またはパスワードが無効です。'; 
            }
          }
    }
}  
}        
?>



<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ログイン</title>
            
    </head>
    <body>
        <font size="7" color="#FF1493">ログイン画面</font><br>
        <form id="loginForm" name="loginForm" action="" method="POST">
            <fieldset>
                <legend>ログインフォーム</legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <label for="userid">ユーザー名</label><input type="text" id="username" name="username" placeholder="ユーザー名を入力"  value="">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <label for="password">メールアドレス</label><input type="mail" id="mail" name="mail" value="" placeholder="メールアドレスを入力">
                <br>
                <input type="submit" id="login" name="login" value="ログイン">
            </fieldset>
        </form>
        <br>
        <form action="mission6-signup.php">
            <fieldset>          
                <legend>新規登録フォーム</legend>
                <input type="submit" value="新規登録">
            </fieldset>
        </form>
    </body>
</html>

