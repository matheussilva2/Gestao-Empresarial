<?php
	include('./modelos/header.php');
	
	require_once('./modulos/colaborador.php');
	checkarAutorizacao(checkarAutorizacao(4));

	require_once("./modelos/entregas.php");
	require_once('./modulos/entregas.php');
?>
<div class="container-fluid mx-0 mx-md-auto py-5 px-0">
		<h1 class="text-center mb-4">Estoque</h1>
		<table class="table table-hover table-light">
			<thead>
				<tr>
					<th>Data</th>
					<th>Nome</th>
					<th>Telefone</th>
					<th>Hotel</th>
					<th>Quarto</th>
					<th>Endereço</th>
					<th>Vendedor</th>
					<th>Produtos</th>
				</tr>
			</thead>
			<tbody>
				<?php
					mostrarTodasEntregas(getEntregas());
				?>
			</tbody>
		</table>
	</div>

<?php
	include("./modelos/footer.php");
?>
<script type="text/javascript" src="./modulos/cookiemanager.js"></script>
<script src="./modulos/checkar-login.js"></script>