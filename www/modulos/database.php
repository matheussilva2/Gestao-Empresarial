<?php
	function conectar(){
		try {
			$conexao = new PDO('mysql:host=localhost;dbname=argila_mais','admin', '@rg1l@m@1s1346',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			return $conexao;
		} catch (PDOException $e) {
			die($e);
		}
	}
?>