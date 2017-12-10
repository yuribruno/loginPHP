<?php

require_once 'Conexao.class.php';
require_once 'Funcoes.class.php';

/**
* 
*/
class User 
{
	private $con;
	private $objFunc;
	private $idUser;
	private $name;
	private $password;
	private $idlog_acesso;
	private $dataAcesso;
	private $objUserlog;
	
	public function __construct()
	{
		$this->con = new Conexao();
		$this->objFunc = new Funcoes();
	}

	public function __set($atributo, $valor)
	{
		$this->$atributo = $valor;
	}

	public function __get($atributo)
	{
		return $this->$atributo;
	}

	public function Seleciona($dado)
	{
		try {
			$this->idUser = $this->objFunc->base64($dado, 2);
			$cst = $this->con->conectar()->prepare("SELECT `idusuario`, `nome`, `senha`, `ativo` FROM `usuario` WHERE `ativo` = 'y'");
			$cst->bindParam(":idUser", $this->idUser, PDO::PARAM_INT);
			$cst->execute();
			return $cst->fetch();
		} catch (PDOException $e) {
			return 'error';
			$e->getMessage();
		}
	}

	public function Select()
	{
		try {
			$cst = $this->con->conectar()->prepare("SELECT `log_acesso`.`idlog_acesso`, `log_acesso`.`data_acesso`, `usuario`.`nome` FROM `log_acesso` INNER JOIN `usuario` ON `log_acesso`.`idusuario` = `usuario`.`idusuario`;");
			$cst->execute();
			return $cst->fetch();
		} catch (PDOException $e) {
			return 'error';
			$e->getMessage();
		}
	}

	public function Insert($dados)
	{
		try {
			$this->name = $this->objFunc->tratarCaracter($dados['name'], 1);
			$this->password = $dados['password'];
			$cst = $this->con->conectar()->prepare("INSERT INTO `usuario` (`nome`, `senha`) VALUES (:name, :password);");
			$cst->bindParam(":name", $this->name, PDO::PARAM_STR);
			$cst->bindParam(":password", $this->password, PDO::PARAM_STR);

			if ($cst->execute()) {
				return 'ok';
			} else {
				return 'error';
			}
		} catch (PDOException $e) {
			return 'error';
			$e->getMessage();
		}
	}

	public function logar($dados)
	{	
		$this->name = $dados['name'];
		$this->password = $dados['password'];
		$this->dataAcesso = $this->objFunc->dataAtual(2);
	
		try {
			$cst = $this->con->conectar()->prepare("SELECT `idusuario`, `nome`, `senha` FROM `usuario` WHERE `nome` = :name AND `senha` = :password;);");
			$cst->bindParam(":name", $this->name, PDO::PARAM_STR);
			$cst->bindParam(":password", $this->password, PDO::PARAM_STR);

			$cst->execute();
			if ($cst->rowCount() == 0) {
				header('location: /MPSCloud/?login=error');
			} else {
				

				session_start();
				$rst = $cst->fetch();
				$_SESSION['logado'] = "sim";
				$_SESSION['user'] = $rst['idusuario'];
				
				
				header('location: /MPSCloud/dashboard');
			}
			
			
		} catch (PDOException $e) {
			return 'Error: '.$e->getMessage();
		}
	}

	public function userlogado($dado){
		$this->idUser = $dado;
		$cst = $this->con->conectar()->prepare("SELECT `idusuario`, `nome` FROM `usuario` WHERE `idusuario` = :idusuario;");
		$cst->bindParam(":idusuario", $this->idUser, PDO::PARAM_STR);
		$cst->execute();
		$rst = $cst->fetch(); 
		$_SESSION['nome'] = $rst['nome'];
	}

	public function logout(){
		session_destroy();
		header('location: /MPSCloud/');
	}

	public function logdeacesso($dado){
		$this->idUser = $dado;
		$cst = $this->con->conectar()->prepare("SELECT `log_acesso`.`data_acesso`, `usuario`.`nome` FROM `log_acesso` INNER JOIN `usuario` ON `log_acesso`.`idusuario` = `usuario`.`idusuario` WHERE `log_acesso`.`idusuario` = :idusuario;");
		$cst->bindParam(":idusuario", $this->idUser, PDO::PARAM_INT);
		$cst->execute();
		return $cst->fetchAll();
	}

	public function addtolog($dado){
		$this->idUser = $dado;
		$this->dataAcesso = $this->objFunc->dataAtual(2);

		try {
			$cst = $this->con->conectar()->prepare("INSERT INTO `log_acesso` (`idusuario`, `data_acesso`) VALUES (:idusuario, :data_acesso);");
			$cst->bindParam(":idusuario", $this->idUser, PDO::PARAM_INT);
			$cst->bindParam(":data_acesso", $this->dataAcesso, PDO::PARAM_STR);
			if($cst->execute()){
				return 'ok';
			} else {
				return 'Error de acesso!';
			}
		} catch (PDOException $e) {
			return 'Error: '.$e->getMessage();
		}
	}

}

?>