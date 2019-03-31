<?php
	require_once('database.php');
	require_once('stockmanager.php');
	
	class Venda{
		function __construct($matricula, $codigo_produto,$valor_produto, $data, $quantidade){
			$this->matricula = $matricula;
			$this->codigo_produto = $codigo_produto;
			$this->data = $data;
			$this->quantidade = $quantidade;
			$this->valor_total = $valor_produto*$this->getQuantidade();
			$this->comissao = $this->getValorTotal()*0.3;
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
		$valor_total = $valor_produto*$quantidade;
		$venda = new Venda($matricula, $codigo_produto, $valor_total, $data, $quantidade);
		return $venda;
	}

	function registrarVenda($vendaObjeto){
		$con = conectar();
		try{
			$prepare = $con->prepare("INSERT INTO venda values ('1',:matricula,:codigo,:total,:data,:quantidade,:comissao)");
			if($prepare->execute([
				'matricula'=>$vendaObjeto->getMatricula(),
				'codigo'=>$vendaObjeto->getCodigoProduto(),
				'total'=>$vendaObjeto->getValorTotal(),
				'data'=>$vendaObjeto->getData(),
				'quantidade'=>$vendaObjeto->getQuantidade(),
				'comissao'=>$vendaObjeto->getComissao(),
			])){
				echo "Registro Inserido";
			}else{
				echo("Falha na inserção");
			}
			echo json_encode(['status'=>'OK','msg'=>'O registro foi feito com sucesso!']);
		}
		catch(PDOException $e){
			echo json_encode(['status'=>'ERROR','msg'=>$sql."<br>".$e->getMessage()]);
		}
	}
	registrarVenda(gerarVenda());
?>