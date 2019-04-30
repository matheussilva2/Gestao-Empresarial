<?php
	require_once('./database.php');
	require_once('./colaborador.php');
	class Entrega{
		function __construct($nome, $telefone, $hotel, $quarto, $endereco, $cookie){
			$this->nome = $nome;
			$this->telefone = $telefone;
			$this->hotel = $hotel;
			$this->quarto = $quarto;
			$this->endereco = $endereco;
			$this->cookie = $cookie;
		}
		function getNome(){
			return $this->nome;
		}
		function getTelefone(){
			return $this->telefone;
		}
		function getHotel(){
			return $this->hotel;
		}
		function getQuarto(){
			return $this->quarto;
		}
		function getEndereco(){
			return $this->endereco;
		}
		function getCookie(){
			return $this->cookie;
		}
	}

	function isEmpty($key){
		return (isset($_POST[$key])?false:true);
	}

	function abrirSolicitacao($entrega){
		$con = conectar();
		try{
			$prepare = $con->prepare("INSERT INTO solicitacaoEntrega VALUES ('null',:nome, :telefone, :hotel, :quarto, :endereco, :vendedor)");
			if($prepare->execute([
				'nome'=>$entrega->getNome(),
				'telefone'=>$entrega->getTelefone(),
				'hotel'=>$entrega->getHotel(),
				'quarto'=>$entrega->getQuarto(),
				'endereco'=>$entrega->getEndereco(),
				'vendedor'=>getUserByToken($entrega->getCookie())['matricula'] ,
			])){
				echo json_encode(['status'=>'OK','msg'=>'Solicitado!']);
			}else
			{
				echo json_encode($prepare->errorInfo());
			}
		}catch(PDOException $e){
			echo json_encode(['status'=>'ERRO','msg'=>$sql."<br>".$e->getMessage()]);
		}

	}

	if(!isEmpty('nome')
	   && !isEmpty('telefone')
	   && !isEmpty('hotel')
	   && !isEmpty('quarto')
	   && !isEmpty('endereco')
		&& !isEmpty('cookie')){
	   	$entrega = new Entrega($_POST['nome'],$_POST['telefone'],$_POST['hotel'],$_POST['quarto'],$_POST['endereco'], $_POST['cookie']);
	   abrirSolicitacao($entrega);
	}else{
		echo(json_encode(['status'=>'ERRO','msg'=>'Há campos faltando!']));
	}
?>