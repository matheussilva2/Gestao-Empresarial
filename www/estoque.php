<?php
	require_once('./modulos/stockmanager.php');
	require_once('./modelos/estoque.php');

	require_once('./modulos/colaborador.php');
	checkarAutorizacao([1]);
	
	$produtos = getProdutos();
?>

<?php
	include('modelos/header.php');
?>

	<div class="container-fluid mx-0 mx-md-auto py-5 px-0">
		<h1 class="text-center mb-4">Estoque</h1>
		<table class="table table-hover table-light">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome</th>
					<th>Custo</th>
					<th>Venda</th>
					<th>Qtd</th>
				</tr>
			</thead>
			<tbody>
				<?php
					mostrar_estoque($produtos);
				?>
			</tbody>
		</table>
	</div>

<?php
	include('./modelos/footer.php');
?>