<?php
	require_once('./database.php');
	require_once('./colaborador.php');
	class Entrega{
		function __construct($nome, $telefone, $hotel, $quarto, $endereco, $cookie, $produtos){
			$this->nome = $nome;
			$this->telefone = $telefone;
			$this->hotel = $hotel;
			$this->quarto = $quarto;
			$this->endereco = $endereco;
			$this->cookie = $cookie;
			$this->produtos = $produtos;
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
		function getProdutos(){
			return $this->produtos;
		}
	}

	function isEmpty($key){
		return (isset($_POST[$key])?false:true);
	}

	function abrirSolicitacao($entrega){
		$con = conectar();
		try{
			$prepare = $con->prepare("INSERT INTO solicitacaoEntrega(nome, telefone, hotel, quarto, endereco, vendedor, produto, data, status) VALUES (:nome, :telefone, :hotel, :quarto, :endereco, :vendedor, :produtos, :data, :status)");
			if($prepare->execute([
				'nome'=>$entrega->getNome(),
				'telefone'=>$entrega->getTelefone(),
				'hotel'=>$entrega->getHotel(),
				'quarto'=>$entrega->getQuarto(),
				'endereco'=>$entrega->getEndereco(),
				'vendedor'=>getUserByToken($entrega->getCookie())['matricula'],
				'produtos'=>$entrega->getProdutos(),
				'data'=>date('Y-m-d'),
				'status'=>0,
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
	   && !isEmpty('cookie')
	   && !isEmpty('produtos')){
	   	$entrega = new Entrega($_POST['nome'],$_POST['telefone'],$_POST['hotel'],$_POST['quarto'],$_POST['endereco'], $_POST['cookie'], $_POST['produtos']);
	   abrirSolicitacao($entrega);
	}else{
		echo(json_encode(['status'=>'ERRO','msg'=>'Há campos faltando!']));
	}
?>