<?php
 header('Content-Type: text/html; charset=UTF-8');
 // mission_3-1開始
 $dsn = 'データベース名';
 $user = 'ユーザー名';
 $password = 'パスワード';
 $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
 // mission_3-1完了

 $sql="CREATE TABLE IF NOT EXISTS tokuten3"
 ."("
 ."id INT PRIMARY KEY AUTO_INCREMENT,"
 ."date varchar(20),"
 ."score varchar(100)"
 .");";
 $stmt=$pdo->query($sql);

session_start();

if(!isset($_SESSION['money']) || !isset($_POST['start'])){
  $_SESSION['money'] = 1000;
  $_SESSION['round'] = 0  ;
}

if(isset($_POST['start'])){
  if($_SESSION['money'] > 0){
  $_SESSION['money'] -= 100;
  $reel_1 = rand(1,4);
  $reel_2 = rand(1,4);
  $reel_3 = rand(1,4);
  $message = "";
  $message = $message."[".$reel_1."]&nbsp;&nbsp;[".$reel_2."]&nbsp;&nbsp;[".$reel_3."]&nbsp;&nbsp;";
    if($reel_1==$reel_2 && $reel_1==$reel_3 && $reel_2 == $reel_3){
      $_SESSION['money'] += 500;
      $_SESSION['round'] += 1 ;
      $message = $message."当た〜り〜！！500円ゲット！<br /><br />".PHP_EOL;
    }else{
      $message = $message."・・・残念！<br /><br />".PHP_EOL;
      $_SESSION['round'] += 1 ;
    }
  }else{
    $message = $message."終了!!!＞＜<br /><br />";
  }
  $message = $message."所持金：".$_SESSION['money']."円<br /><br />";
  $message2 = $_SESSION['round']."ラウンド生き残りました。<br /><br />";
}

if($_SESSION['money'] > 0){
  $buttonName = 'start';
  $buttonValue = 'スロットをまわす！';
}else{
  $buttonName = 'replay';
  $buttonValue = 'ゲームオーバー(再挑戦する？)';
  $message = $message."終了!!!＞＜<br /><br />";
}

if ($buttonValue == 'ゲームオーバー(再挑戦する？)') {
  $date = date( "Y年m月d日  H時i分" );
  $score = $message2;

  $sql  =  $pdo  ->  prepare("INSERT  INTO  tokuten3 (date,score)  VALUES  (:date,:score)");
        $sql  ->  bindParam(':date',  $date,  PDO::PARAM_STR);   
        $sql  ->  bindParam(':score',$score,  PDO::PARAM_STR);
        $sql  ->  execute();
}

?>
<html>
<head>
<title>スロットゲーム</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<style type = "text/css">
h1 { color: blue; text-decoration:underline }
p { text-indent:5mm; background:rgb(180,180,105)}

</style>

<body>
<p><a href="mission6-login.php">ログインページへ戻る</a></p>
<h1>あなたは何ラウンド生き残れるか！？</h1>
<p>スロットは一回100円です。</p>

<form  method="post">
  <input type="submit" name="<?php echo $buttonName; ?>" value="<?php echo $buttonValue; ?>" />
</form>

<?php echo $message; ?>
<?php echo $message2; ?>
<form method = "post">
 <input type="text" name="name" placeholder="名前" value = "<?php echo $edit[1] ;?>" size = "20">
 <br>
 <input type="text" name="comment" placeholder="コメント" value = "<?php echo $edit[2] ;?>" size = "20">
 <br>
 <input type="text" name="password" placeholder="パスワード" value = "<?php echo $edit[4] ;?>">
 <input type="submit" value="送信" >
 <input type="text" name="number2_sub"  style ="visibility:hidden" value = "<?php echo $edit[0] ;?>" >
 <br>
 <br>
 <input type="text" name="number" placeholder="削除対象番号" size ="20">
 <br>
 <input type="text" name="password1" placeholder="パスワード" >
 <input type="submit" value="削除" >
 <br>
 <input type="text" name="number2" placeholder="編集行番号" size ="20">
 <br>
 <input type="text" name="password2" placeholder="パスワード" >
 <input type="submit" value="編集" >
 </form>
 
</body>
</html>

<?
 //mission3-6
 $sql6  =  'SELECT  *  FROM  tokuten3';
 $results  =  $pdo  ->  query($sql6);
 foreach  ($results  as  $row){
        //$rowの中にはテーブルのカラム名が入る
        echo  $row['id'].'  ーーー ,';
        echo  $row['date'].'  ーーー,';
        echo  $row['score'].'<br>';
 }
 //mission3-6

 ?>