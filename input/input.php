<html lang="ja">
<head>
  <title>connection test</title>
</head>

<body>
<!-- プロフィールようフォーム -->
<!--<form action="input.php" method="POST" accept-charset="utf-8">-->
<!--  氏名<br><input type="text" name="name"><br>-->
<!--  ふりがな<br><input type="text" name="furigana"><br>-->
<!--  生年月日<br><input type="date" name="bd"><br>-->
<!--  出身<br><input type="text" name="native"><br>-->
<!--  現住所<br><input type="text" name="address"><br>-->
<!--  <input type="submit">-->
<!--</form>-->

<!--テスト用-->
<form action="input.php" method="POST" accept-charset="utf-8">
  test <input type="text" name="hobbydata">
  <input type="submit">
</form>

<?php
ini_set( 'display_errors', 1 );

if($_SERVER['REQUEST_METHOD']=='POST'){
 // 環境によってMySQLのパスが違うので注意
 // $link = mysql_connect('localhost','root','kuroro');
 // if(!$link){die('connection failed '.mysql_error());}
  try {
    //POD(SQLサービス:接続DB名;接続アドレス;エンコ;ユーザ名;pass);
    $pdo = new PDO('mysql:dbname=myself;host=localhost;charset=utf8','root','fuyuki');
  } catch (PDOException $e) {
      print('Connection failed:'.$e->getMessage());
    die();
  }

  //SQL文発行，メソッドを用意するならこれを分割
  //$sql = "INSERT INTO profile (name,furigana,bd,native,address) VALUE(?,?,?,?,?)";
  $sql = "INSERT INTO hobby (id,hobbydata) values (:id,:hobbydata);";

  //コネクションとSQL文を基にしてクエリの準備(ステートメントの作成)
  $stm = $pdo -> prepare($sql);
    //
    if(!$stm){
        $info = $pdo -> errorInfo();
        exit($info[2]);
    }

  var_dump($_POST);
    print('------------------ ');
  print($_POST['hobbydata']);

  //executeでクエリの実行，正否は真偽が返る
  //$flg = $sql->execute(array($_POST['name'],$_POST['furigana'],$_POST['bd'],$_POST['native'],$_POST['address']));
  //bindValue('プレースホルダ','オブジェクト',バインドする型(str省略可));
//  $stm ->bindValue(':hobbydata',$_POST['hobbydata'],PDO::PARAM_STR);
    $stm -> bindValue(':id',rand(1,10));
    $stm -> bindValue(':hobbydata',$_POST['hobbydata']);
  $flg =  $stm  ->execute();

  if($flg){
    print('レコードを追加');
  }else{
    print('レコードの追加に失敗');
  }
}

$dbh=null;
?>
</body>
</html>
