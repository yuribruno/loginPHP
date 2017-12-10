<?php

/**
* 
*/
class Conexao 
{
	private $user;
	private $password;
	private $base;
	private $server;
	private static $pdo;
	
	public function __construct()
	{
		$this->server = "127.0.0.1";
		$this->base = "mps_db";
		$this->user = "root";
		$this->password = " ";
	}

	public function conectar(){
		try {
			if (is_null(self::$pdo)) {
				self::$pdo = new PDO("mysql:dbname=mps_db;host=localhost;charset=utf8;","root","");
			}
			return self::$pdo;
			
		} catch (PDOException $e) {
			return 'Error: ' . $e->getMessage();
		}
	}
}

?>