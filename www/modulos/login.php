<?php
	include_once 'Authorization.php';
	function connectToDatabase(){
		return new PDO('mysql:host=localhost;dbname=authorization', 'root', '');
	}

	function login(){
		$user = isset($_POST['user'])?$_POST['user']:'';
		$pass = md5(isset($_POST['password'])?$_POST['password']:'');
		$auth = getAuth(connectToDatabase());

		$try = $auth->login($user,$pass);
		if($try === true){
			setcookie("_session", $auth->getUserSession()['token'], time()+99*55, "/");
			setcookie("user", $user, time()+99*55, "/");

			echo json_encode([ 'token' => $auth->getUserSession()['token'], 'user' => $user, ]);
		} else {
			echo json_encode([ 'error' => $try['error'], ]);
		}
	}

	function logout(){	
		$auth = getAuth(connectToDatabase());
		$auth->disableToken($_COOKIE["_session"]);
		unset($_COOKIE["_session"]);
		unset($_COOKIE["user"]);
	}

	function getAuth($conn){
		$auth = new Authorization($conn);
		return $auth;
	}

	function verifyToken(){
		$auth = new Authorization(connectToDatabase());
		$response = $auth->verifyToken($_COOKIE["_session"]);
		if($response === true){
			echo json_encode(['status'=>'OK','msg'=>'Token Válido!']);
		}else{
			echo json_encode(['status'=>'FALHA','msg'=>'Token Inválido!']);
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
