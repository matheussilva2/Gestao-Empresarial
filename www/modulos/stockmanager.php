<?php
	require_once('database.php');

	function acharProdutoPorId($id){
		$con = conectar();
		$sql = "SELECT * FROM produto WHERE id=$id";
		$query = $con->query($sql);
		$produto = $query->fetch();
		return $produto;
	}

	function getProdutos(){
		$con = conectar();
		$sql = "
		SELECT produto.id, produto.nome, produto.preco_venda, produto.preco_custo, estoque.quantidade
		FROM produto
		INNER JOIN estoque
		";
		$query = $con->query($sql);
		return $query->fetchAll();
	}
?>