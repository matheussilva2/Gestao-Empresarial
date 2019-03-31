<?php
	function conectar(){
		try {
			$conexao = new PDO('mysql:host=localhost;dbname=argila_mais','root', '');
			return $conexao;
		} catch (PDOException $e) {
			return $e;
		}
	}
?>