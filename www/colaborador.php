<?php
	require_once('modulos/colaborador.php');
	$hoje = date('Y-m-d');
	$semana = subtrairData(new DateTime($hoje),7);
	$mes = subtrairData(new DateTime($hoje),30);
	$colaborador = isset($_COOKIE['_session'])?getUserByToken($_COOKIE['_session']):['nome'=>'Você não está logado!'];
	function converterData($string){
		return implode('/',array_reverse(explode('-', $string)));
	}
	function subtrairData($dataInicial, $dias){
		$dataInicial->sub(new DateInterval('P'.$dias.'D'));
		return $dataInicial->format('Y-m-d');
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Argila Mais - Colaborador</title>
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
		<!-- Resumo do Colaborador -->

		<div class="container-fluid bg-success pb-3">
			<img src="./galeria/default-user.png" class="rounded-circle text-white mt-4 mb-2" width="25%" alt="imagem do usuário" style="margin-left: 37%;">
			<h2 class="h4 text-center text-light mb-2"><?php echo $colaborador['nome'];?></h2>
			<p class="text-white text-center m-0">
				<strong>Situação:</strong>
				<?php
					echo "Trabalhando";
				?>
			</p>
		</div>
		
		<!-- Informações Gerais sobre o Colaborador -->
		<div class="container-fluid bg-white p-0">
			<div id="infoColaborador">
				<!--Campo-->
				<button type="button" class="btn text-dark font-weight-bold py-3 bg-white w-100 b-0" data-target="#infoGerais" data-toggle="collapse"><h4>Informações Gerais</h4></button>
				<div class="px-4 py-2 collapse" id="infoGerais" data-parent="#infoColaborador">
					<div class="row">
						<div class="col-4"><strong>Matrícula</strong>: </div>
						<div class="col-8"><?php echo $colaborador["matricula"];?></div>
					</div>
					<div class="row">
						<div class="col-4"><strong>Nome</strong>: </div>
						<div class="col-8"><?php echo $colaborador["nome"];?></div>
					</div>
					<div class="row">
						<div class="col-4"><strong>Nascimento</strong>: </div>
						<div class="col-8"><?php echo converterData($colaborador['nascimento']);?></div>
					</div>
					<div class="row">
						<div class="col-4"><strong>CPF</strong>: </div>
						<div class="col-8"><?php echo $colaborador["cpf"];?></div>
					</div>
					<div class="row">
						<div class="col-4"><strong>RG</strong>: </div>
						<div class="col-8"><?php echo $colaborador["rg"];?></div>
					</div>
					<div class="row">
						<div class="col-4"><strong>Cargo</strong>: </div>
						<div class="col-8"><?php echo ucfirst($colaborador["cargo"]);?></div>
					</div>
				</div>

				<!--Campo-->
				<button data-toggle="collapse" data-target="#resumoVendas" class="btn text-dark font-weight-bold bg-white w-100 b-0 py-3">
					<h4>Resumo de Vendas</h4>
				</button>

				<div class="collapse" id="resumoVendas" data-parent="#infoColaborador">

					<button data-toggle="collapse" data-target="#quantidadeVendas"class="btn text-dark font-weight-bold bg-light w-100 b-0 py-3">Vendas</button>
					<div id="quantidadeVendas" class="collapse" data-parent="#resumoVendas">
						<div class="row p-3">
							<div class="col-6"><strong>Hoje</strong></div>
							<div class="col-6">
								<?php
								echo getQuantidadeVendas($colaborador['matricula'],$hoje, $hoje)['quantidade'];
								?>
							</div>
							<div class="col-6"><strong>Semana</strong></div>
							<div class="col-6">
								<?php 
									echo getQuantidadeVendas($colaborador['matricula'],subtrairData(new DateTime($hoje),7),$hoje)['quantidade'];
								?>
							</div>
							<div class="col-6"><strong>Mês</strong></div>
							<div class="col-6">
								<?php 
									echo getQuantidadeVendas($colaborador['matricula'],subtrairData(new DateTime($hoje),30),$hoje)['quantidade'];
								?>
							</div>
						</div>
					</div>

					<button data-toggle="collapse" data-target="#lucro" class="btn text-dark font-weight-bold bg-light w-100 b-0 py-3">Lucro</button>
					<div id="lucro" class="collapse" data-parent="#resumoVendas">
						<div class="row p-3">
							<div class="col-6"><strong>Hoje</strong></div>
							<div class="col-6">R$
								<?php 
									echo getQuantidadeVendas($colaborador['matricula'],$hoje,$hoje)['valor'];
								?>
							</div>
							<div class="col-6"><strong>Semana</strong></div>
							<div class="col-6">R$
								<?php 
									echo getQuantidadeVendas($colaborador['matricula'],subtrairData(new DateTime($hoje),7),$hoje)['valor'];
								?>
							</div>
							<div class="col-6"><strong>Mês</strong></div>
							<div class="col-6">R$
								<?php 
									echo getQuantidadeVendas($colaborador['matricula'],subtrairData(new DateTime($hoje),30),$hoje)['valor'];
								?>
							</div>
						</div>
					</div>
					<button data-toggle="collapse" data-target="#mediaVendas" class="btn text-dark font-weight-bold bg-light w-100 b-0 py-3">Média de Vendas</button>
					<div id="mediaVendas" class="collapse" data-parent="#resumoVendas">
						<div class="row p-3">
							<div class="col-6"><strong>Semana</strong></div>
							<div class="col-6">
								<?php 
									echo (int)getMediaVendas($colaborador['matricula'],subtrairData(new DateTime($hoje),7),$hoje)['quantidade'];
								?>
							</div>
							<div class="col-6"><strong>Mês</strong></div>
							<div class="col-6">
								<?php 
									echo (int)getMediaVendas($colaborador['matricula'],subtrairData(new DateTime($hoje),30),$hoje)['quantidade'];
								?>
							</div>
						</div>
					</div>
					<button data-toggle="collapse" data-target="#mediaLucro" class="btn text-dark font-weight-bold bg-light w-100 b-0 py-3">Média Lucro</button>
					<div id="mediaLucro" class="collapse" data-parent="#resumoVendas">
						<div class="row p-3">
							<div class="col-6"><strong>Semana</strong></div>
							<div class="col-6">R$
								<?php
									echo number_format(getMediaVendas($colaborador['matricula'],subtrairData(new DateTime($hoje),7),$hoje)['valor'],2);
								?>
							</div>
							<div class="col-6"><strong>Mês</strong></div>
							<div class="col-6">R$
								<?php 
									echo number_format((float)getMediaVendas($colaborador['matricula'],subtrairData(new DateTime($hoje),30),$hoje)['valor'],2);
								?>
							</div>
						</div>
					</div>
						
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./modulos/cookiemanager.js"></script>
		<script type="text/javascript">
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
						if(res['status']!='OK'){
							location.href="./login.php";
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