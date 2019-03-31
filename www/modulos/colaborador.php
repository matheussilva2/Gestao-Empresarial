<?php
	require_once('database.php');

	function procurarTodosColaboradores(){
		$con = conectar();
		$sql = "SELECT * FROM colaborador";
		$prepare = $con->prepare($sql);
		$prepare->execute();
		return $prepare->fetchAll();
	}
?>