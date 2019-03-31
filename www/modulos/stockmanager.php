<?php
	require_once('database.php');

	function acharProdutoPorId($id){
		$con = conectar();
		$sql = "SELECT * FROM produto WHERE id=$id";
		$query = $con->query($sql);
		$produto = $query->fetch();
		return $produto;
	}
?>