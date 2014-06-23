<?php 
//SQLのコネクション生成や格納、出力を行う
class MySQLConnection{
	private $pdo;

	public function conect(){
		try {
    //POD(SQLサービス:接続DB名;接続アドレス;エンコ;ユーザ名;pass);
			$this -> $pdo = new PDO('mysql:dbname=myself;host=localhost;charset=utf8','root','fuyuki');
		} catch (PDOException $e) {
			print('Connection failed:'.$e->getMessage());
			die();
		}
	}

	//コネクションとSQL文を基にしてクエリの準備(ステートメントの作成)
	//postかgetで分けたい　呼び出し元で分岐か→これいらなくね？
	public function sqlQuery($_SERVER){
		if($_SERVER['REQUEST_METHOD']=='POST'){


		}elseif ($_SERVER['REQUEST_METHOD']=='GET') {
		//出力用	
		}
	}

	public function close(){
		$this -> $pdo = null;
	}

	//GETを受け取って出力する
	//出力は query(),fetch()
	//fetchはPDOStatementオブジェクトのクエリ実行結果？から1行取得
	public function outputMyself(){

	}
	//POSTを受け取って格納する
	//格納は execute()
	public function inputMyself(){
		//入力用	
			$sql = "INSERT INTO hobby (id,hobbydata) values (:id,:hobbydata);";

		//ステートメント生成
			$stm = $this -> $pdo -> prepare($sql);
		//エラー確認
			if(!$stm){
				$info = $this -> $pdo -> errorInfo();
				exit($info[2]);
			}
		//格納処理の実行
			$flg =  $stm  ->execute();

			if($flg){
				print('レコードを追加');
			}else{
				print('レコードの追加に失敗');
			}
	}

}
