<?php
	require_once('./database.php');
	class Entrega{
		function __construct($nome, $telefone, $hotel, $quarto, $endereco){
			$this->nome = $nome;
			$this->telefone = $telefone;
			$this->hotel = $hotel;
			$this->quarto = $quarto;
			$this->endereco = $endereco;
		}
	}

	function isEmpty($key){
		return (isset($_POST[$key])?false:$_POST[$key]);
	}

	function abrirSolicitacao($entrega){
		$con = conectar();
		$sql = "INSERT INTO solicitacoesVendas
				VALUES (:nome, :telefone, :hotel, :quarto, :endereco)";
		echo json_encode(['status'=>'OK','msg'=>'Solicitado!']);

	}

	if(!isEmpty('nome')
	   && !isEmpty('telefone')
	   && !isEmpty('hotel')
	   && !isEmpty('quarto')
	   && !isEmpty('endereco')){
	   	$entrega = new Entrega($_POST['nome'],$_POST['telefone'],$_POST['hotel'],$_POST['quarto'],$_POST['endereco']);
	   abrirSolicitacao($entrega);
	}else{
		echo(json_encode(['status'=>'ERRO','msg'=>'Há campos faltando!']));
	}
?>