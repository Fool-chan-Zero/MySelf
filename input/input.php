<?php
ini_set( 'display_errors', 1 );

if($_SERVER['REQUEST_METHOD']=='POST'){

	try {
		$pdo = new PDO('mysql:host=localhost;dbname=myself;charset=utf8','root','fuyuki',
			array(PDO::ATTR_EMULATE_PREPARES => false)
			);
	} catch (PDOException $e) {
		print('Connection failed:'.$e->getMessage());
		die();
	}
	
	$name = null;
	
	$sql = "INSERT INTO profile (name,furigana,bd,native,address) VALUE(?,?,?,?,?)";
	$sth = $pdo -> prepare($sql);
	var_dump($_POST);

	$flg = $sql->execute(array($_POST['name'],$_POST['furigana'],$_POST['bd'],$_POST['native'],$_POST['address']));
	if($flg){
		print('レコードを追加');
	}else{
		print('レコードの追加に失敗');

	}
}

$dbh=null;
?>