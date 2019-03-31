<?php
	require_once('./modulos/colaborador.php');
	require_once('./modulos/produto.php');
	$colaboradores = procurarTodosColaboradores();
	$produtos = procurarTodosProdutos();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Argila Mais - Registro de Vendas</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	</head>
	<body class="bg-light">
		<header class="navbar navbar-expand-lg bg-success navbar-dark p-0 p-lg-2">
			<h1 class="navbar-brand d-none d-lg-inline">Argila Mais</h1>

			<button class="navbar-toggler m-2" type="button" data-toggle="collapse" data-target="#navMobile">
			<span class="navbar-toggler-icon"></span>
			</button>
			<nav id="navMobile" class="collapse navbar-collapse">
				<img alt="imagem do usuário" src="./galeria/default-user.png" class="rounded-circle m-4 text-white" width="20%">
				<ul class="navbar-nav w-100">
					<li class="nav-item"><a class="text-white pl-4 btn btn-success nav-link text-left">Início</a></li>
					<li class="nav-item"><a class="text-white pl-4 btn btn-success nav-link text-left">Registro de Ponto</a></li>
					<li class="nav-item"><a class="text-white pl-4 btn btn-success nav-link text-left">Minhas Vendas</a></li>
					<li class="nav-item"><a class="text-white pl-4 btn btn-success nav-link text-left">Gerenciar Estoque</a></li>
					<li class="nav-item"><a class="text-white pl-4 btn btn-success nav-link text-left">Gerenciar Colaboradores</a></li>
				</ul>
			</nav>
		</header>
			
		<h2 class="text-center my-4">Registro de Vendas</h2><hr>
		<div style="display: none;" class="alert alert-success alert-dismissible mx-3" id="sucessNotification">
			<p><strong>Sucesso!</strong> A venda foi registrada.</p>
			<button class="close" type="button" data-dismiss="alert">&times;</button>
		</div>
		<form class="formulario mx-auto">
			<label class="w-25 font-weight-bold">Vendedor: </label>
			<select id="matricula" class="w-50 mb-2" required>
				<!-- Mostrar todos os vendedores -->
				<?php
					for($i=0;$i<count($colaboradores);$i++){
						if($colaboradores[$i]['cargo'] == 'vendedor'){
							echo "<option value=".$colaboradores[$i]['matricula'].">".$colaboradores[$i]['nome']."</option>";
						}
					}
				?>
			</select><br>
			<label class="w-25 font-weight-bold">Produto: </label>
			<select id="produto" class="w-50 mb-2" required>
				<?php
					for($i=0;$i<count($produtos);$i++){
						echo "<option value=".$produtos[$i]['id'].">".$produtos[$i]['nome']."</option>";
					}
				?>
			</select><br>
			<label class="w-25 font-weight-bold">Quantia: </label>
			<input class="w-50 mb-2" type="number" id="quantidade" min="0" required>
			<label class="w-25 font-weight-bold">Data: </label>
			<input value="<?php echo date('Y-m-d');?>" type="date" id="data" required><hr>
			<input type="button" value="Enviar" class="btn btn-success w-100 btn-lg" id="enviar">
		</form>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			
			$("#enviar").click(function(){
				$.ajax({
					url: './modulos/venda.php',
					type: 'POST',
					data: {
						matricula: $("select#matricula").children('option:selected').val(),
						codigo: $("select#produto").children('option:selected').val(),
						data: $("#data").val(),
						quantidade: $("#quantidade").val()
					},
				})
				.done(function(event){
					if(JSON.parse(event)['status']=='OK'){
						$("#sucessNotification").fadeIn();
					}
				})
				.fail(function() {
					alert("Algo errado aconteceu! Entre em contato com o desenvolvedor.");
				});
			});
		</script>
	</body>
</html>