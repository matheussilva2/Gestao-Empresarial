<?php
	include('./modelos/header.php');
	
	require_once('./modulos/colaborador.php');
	checkarAutorizacao([1]);

	require_once("./modelos/entregas.php");
	require_once('./modulos/entregas.php');
?>
<div class="container mx-0 mx-md-auto py-5 px-0">
		<h1 class="text-center mb-4">Entregas</h1>
		<table class="table table-hover table-light">
			<thead>
				<tr>
					<th>Data</th>
					<th>Nome</th>
					<th>Opções</th>
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