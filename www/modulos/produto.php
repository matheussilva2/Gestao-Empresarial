<?php
	require_once('database.php');

	function procurarTodosProdutos(){
		$con = conectar();
		$sql = "SELECT * FROM produto";
		$prepare = $con->prepare($sql);
		$prepare->execute();
		return $prepare->fetchAll();
	}
?>