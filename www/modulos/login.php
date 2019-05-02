<?php
	include_once 'Authorization.php';
	include_once 'database.php';

	function login(){
		$user = isset($_POST['user'])?$_POST['user']:'';
		$pass = isset($_POST['password'])?md5($_POST['password']):'';
		$auth = getAuth(conectar());

		$try = $auth->login($user,$pass);
		if($try === true){
			setcookie("_session", $auth->getUserSession()['token'], time()+99*55, "/");
			echo json_encode([ 'status'=>'OK','token' => $auth->getUserSession()['token'], 'user' => $user, ]);
		} else {
			echo json_encode([ 'status'=>'ERROR','error' => $try['error'], ]);
		}
	}

	function logout(){	
		$auth = getAuth(conectar());
		$auth->disableToken($_COOKIE["_session"]);
		unset($_COOKIE["_session"]);
	}

	function getAuth($conn){
		$auth = new Authorization($conn);
		return $auth;
	}

	function verifyToken(){
		$auth = new Authorization(conectar());
		$response = $auth->verifyToken($_COOKIE["_session"]);
		if($response === true){
			echo json_encode(['status'=>'OK','msg'=>'Token Válido!']);
		}else{
			echo json_encode(['status'=>'FALHA','msg'=>'Token Inválido! ']);
		}
	}

	function getTokenInfo(){
		
	}

	$action = isset($_POST['action'])?$_POST['action']:'';
	switch ($action) {
		case 'login':
			login();
			break;
		
		case 'logout':
			logout();
			break;
		case 'verifyToken':
			verifyToken();
			break;
		default:
			echo json_encode(['status'=>'ERROR','msg'=>'Operação não definida ou incorreta!']);
			break;
	}
?>
