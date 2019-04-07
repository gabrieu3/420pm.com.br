<?php
Class DbConnection{

	private $conn;

	public function __construct(){
		$this->conn = mysqli_connect("localhost","root","","sitezin") or die("Couldn't connect");
	}

	public function getDBConnect(){
        return $this->conn;
  }

}

// Quando sobe para o Hostinger deve-se utilizar esta conexao
//
// Class DbConnection{
//
// 	private $conn;
//
// 	public function __construct(){
// 		$this->conn = mysqli_connect("mysql.hostinger.com.br","u658703427_sns","serounaoser12345","u658703427_sns") or die("Couldn't connect");
// 	}
//
// 	public function getDBConnect(){
//         return $this->conn;
//     }
//
// }


?>
