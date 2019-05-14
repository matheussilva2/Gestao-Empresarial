<?php
	require_once('modulos/config.php');

	
	function showMenu(){
		require_once('modulos/colaborador.php');
		$colaborador = getUserByToken($_COOKIE['_session']);
		$menu = [];
		array_push($menu, ['nome'=>'Início','url'=>'colaborador.php']);
		array_push($menu, ['nome'=>'Vendas','url'=>'minhas-vendas.php']);
		if(in_array($colaborador['permissao'], [ADMIN])){
			array_push($menu, ['nome'=>'Estoque','url'=>'estoque.php']);
			array_push($menu, ['nome'=>'Gerenciar Colaboradores','url'=>'colaboradores.php']);
		}

		$html = "";
		
		for ($i=0; $i < count($menu);$i++) {
			$html .= '<li class="nav-item"><a class="text-white pl-4 btn btn-success nav-link text-left" href="./'.$menu[$i]['url'].'">'.$menu[$i]['nome'].'</a></li>';
		}
		return $html;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Argila Mais</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		
	</head>
	<body class="bg-light">
		<header class="navbar navbar-expand-lg bg-success navbar-dark p-0 p-lg-2">
			<h1 class="navbar-brand d-none d-lg-inline">Argila Mais</h1>

			<button class="navbar-toggler m-2" type="button" data-toggle="collapse" data-target="#navMobile">
			<span class="navbar-toggler-icon"></span>
			</button>
			<nav id="navMobile" class="collapse navbar-collapse">
				<img alt="imagem do usuário" src="./galeria/default-user.png" class="rounded-circle m-4 text-white d-block d-xl-none" width="20%">
				<ul class="navbar-nav w-100 list-unstyled">
					<?php echo showMenu(); ?>
				</ul>
			</nav>
		</header>