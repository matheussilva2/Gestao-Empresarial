<?php
	require_once('database.php');

	function getEntregas(){
		$con = conectar();
		$sql = "SELECT * FROM solicitacaoentrega";
		$query = $con->query($sql);
		return $query->fetchAll();
	}

	function getEntregasPendentes(){
		$con = conectar();
		$sql = "SELECT * FROM solicitacaoentrega WHERE status='0'";
		$query = $con->query($sql);
		return $query->fetchAll();
	}

	function trocarStatus(){
		if($_GET['id'] != '' && $_GET['status'] != ''){
			try{
				$con = conectar();
				$status = $_GET['status'];
				$id = $_GET['id'];
				$sqlEntrega = "
						UPDATE solicitacaoentrega
						SET status = $status
						WHERE id = $id
						";

				$prepare = $con->prepare($sqlEntrega);
				$prepare->execute();
				echo json_encode(['status'=>'OK', 'msg'=>'Entrega atualizada!']);
			}
			catch(PDOException $e){
				die(json_encode(['status'=>'ERRO','msg'=>'<br>'.$e->getMessage()]));
			}
		}else{
			die(json_encode(['status'=>'ERRO','msg'=>'Há campos faltando!']));
		}
	}

	function checkarGet($value){
		return isset($_GET[$value])?true:false;
	}

if(isset($_GET['action'])){
	if($_GET['action'] == 1){
		trocarStatus();
	}
}
?>