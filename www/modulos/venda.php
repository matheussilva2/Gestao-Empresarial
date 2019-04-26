<?php
	require_once('database.php');
	require_once('stockmanager.php');
	
	class Venda{
		function __construct($matricula, $codigo_produto,$valor_produto, $data, $quantidade, $emissor){
			$this->matricula = $matricula;
			$this->codigo_produto = $codigo_produto;
			$this->data = $data;
			$this->quantidade = $quantidade;
			$this->valor_total = $valor_produto*$this->getQuantidade();
			$this->comissao = $this->getValorTotal()*0.3;
			$this->emissor = $emissor;
		}
		function getEmissor(){
			return $this->emissor;
		}
		function getMatricula(){
			return $this->matricula;
		}
		function getCodigoProduto(){
			return $this->codigo_produto;
		}
		function getValorTotal(){
			return $this->valor_total;
		}
		function getData(){
			return $this->data;
		}
		function getQuantidade(){
			return $this->quantidade;
		}
		function getComissao(){
			return $this->comissao;
		}
	}
	
	function gerarVenda(){
		$matricula = isset($_POST['matricula'])?$_POST['matricula']:'0';
		$codigo_produto = isset($_POST['codigo'])?$_POST['codigo']:'0';
		$data = isset($_POST['data'])?$_POST['data']:'0';
		$valor_produto = acharProdutoPorId($codigo_produto)['preco_venda'];
		$quantidade = isset($_POST['quantidade'])?$_POST['quantidade']:'0';
		$emissor = isset($_POST['emissor'])?$_POST['emissor']:'0';
		$venda = new Venda($matricula, $codigo_produto, $valor_produto, $data, $quantidade, $emissor);
		return $venda;
	}

	function registrarVenda($vendaObjeto){
		$con = conectar();
		try{
			$prepare = $con->prepare("
				INSERT INTO venda (matricula_vendedor,codigo_produto, valor, data, quantidade, comissao, emissor)
				values (:matricula,:codigo_produto,:total,:data,:quantidade,:comissao, :emissor)
				");

			if($prepare->execute([
				'matricula'=>$vendaObjeto->getMatricula(),
				'codigo_produto'=>$vendaObjeto->getCodigoProduto(),
				'total'=>$vendaObjeto->getValorTotal(),
				'data'=>$vendaObjeto->getData(),
				'quantidade'=>$vendaObjeto->getQuantidade(),
				'comissao'=>$vendaObjeto->getComissao(),
				'emissor'=>$vendaObjeto->getEmissor()
			]))
			{
				echo json_encode(['status'=>'OK','msg'=>'O registro foi feito com sucesso!']);
			}
			else
			{
				echo json_encode($prepare->errorInfo());
			}
		}
		catch(PDOException $e){
			echo json_encode(['status'=>'ERROR','msg'=>$sql."<br>".$e->getMessage()]);
		}
	}
	registrarVenda(gerarVenda());
?>