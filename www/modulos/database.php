<?php
	require_once("config.php");
	
	function conectar(){
		try {
			$conexao = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER, PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			return $conexao;
		} catch (PDOException $e) {
			die($e);
		}
	}
?>