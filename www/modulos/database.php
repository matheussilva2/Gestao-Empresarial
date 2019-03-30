<?php
	$host = 'localhost';
	$database = 'argilamais';
	$usuario = 'admin';
	$senha = '@rg1l@m@1s1346';

	function iniciar(){
		$operacao = isset($_POST['operacao'])?$_POST['operacao']:"nulo";
		switch ($operacao) {
			case 'inserir':
				inserirRegistro($_POST['tabela'],$_POST['valores']);
				break;
			
			default:
				echo ['status'=>'ERROR','msg'=>'Operação não informada!'];
				break;
		}
	}

	function conectar(){
		try {
			$conexao = new PDO('mysql:host=$host;dbname=$database',$usuario, $senha);
			return $conexao;
		} catch (PDOException $e) {
			return $e;
		}
	}

	function inserirRegistro($tabela, $valores){
		try{
			$sql = "INSERT INTO $tabela VALUES $valores";
			$con = conectar();
			$con->exec($sql);
			return ['status'=>'OK','msg'=>'O registro foi feito com sucesso!'];
		}
		catch(PDOException $e){
			return ['status'=>'ERROR','msg'=>$sql."<br>".$e->getMessage()];
		}
		$con->close();
	}
?>