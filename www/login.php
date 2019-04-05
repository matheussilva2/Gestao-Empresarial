<!DOCTYPE html>
<html>
<head>
	<title>Argila Mais - Entrar</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style type="text/css">
		.formulario{
			padding: 15px;
			font-size: 16px;
			width: 100%;
			max-width: 350px;
			margin-top: 100px;
		}
		input{
			border-bottom-right-radius: 0px;
			border-bottom-left-radius: 0px;
		}
		#senha{
			border-top: 0px;
			border-top-right-radius: 0px;
			border-top-left-radius: 0px;
		}
	</style>

</head>
<body class="bg-light">
	<header class="navbar bg-success navbar-dark">
		<h1 class="navbar-brand">Argila Mais - Entrar</h1>
	</header>
	<form class="mx-auto form-group formulario">
		<h2 class="h1 text-center font-weight-normal">Entrar</h2>
		<input id="user" type="number" name="matricula" id="matricula" class="form-control" placeholder="matrícula" required>
		<input id="password" type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
		
		<input type="button" class="mt-4 btn btn-success btn-lg w-100" value="Entrar" id="entrarBtn">
		<div id="notificacao" style="display: none" class="alert alert-danger mt-3">
			<button id="notificacaoClose" class="close" type="button">&times;</button>
			<strong>Falha!</strong><span id="notificacaoMsg"></span>
		</div>
	</form>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./modulos/cookiemanager.js"></script>
	<script>
		$(document).ready(function(){
			$('#notificacaoClose').click(function(event) {
				$('#notificacao').slideUp();
			});

			$("#entrarBtn").click(function(){
				$.ajax({
					url: './modulos/login.php',
					type: 'POST',
					data: {
						action: 'login',
						user: $('#user').val(),
						password: $('#password').val()
					},
					})
					.done(function(msg) {
						var msg = JSON.parse(msg);
						if(msg['status']=='OK'){
							location.href="./colaborador.php";
						}else{
							$("#notificacaoMsg").html('&nbsp;Matrícula ou senha incorretas!');
							$("#notificacao").slideDown();
						}
					});
				});
			});
		function validarCookie(cookie){
			if(cookie != ''){
				$.ajax({
					url: './modulos/login.php',
					type: 'POST',
					data: {
						action: 'verifyToken',
					},
				})
				.done(function(msg) {
					var res = JSON.parse(msg);
					if(res['status']=='OK'){
						location.href="./colaborador.php";
					}
				})
				.fail(function() {
					alert("Algo deu errado! Recarregue a página ou contate o administrador!");
				})
				
			}
		}
		validarCookie(getCookie('_session'));
	</script>
</body>
</html>