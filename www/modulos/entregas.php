<?php
	require_once('database.php');

	function getEntregas(){
		$con = conectar();
		$sql = "SELECT * FROM solicitacaoentrega";
		$query = $con->query($sql);
		return $query->fetchAll();
	}
?>