<?php
	include('./modelos/header.php');
	
	require_once('./modulos/colaborador.php');
	checkarAutorizacao([1]);

	require_once("./modelos/entregas.php");
	require_once('./modulos/entregas.php');
?>
<div class="container mx-0 mx-md-auto py-5 px-0">
	<strong class="ml-2">Filtrar Entregas: </strong>
	<select>
		<option value="todas">Todas</option>
		<option selected value="pendentes">Pendentes</option>
		<option value="concluidas">Concluídas</option>
		<option value="canceladas">Canceladas</option>
	</select>
		<h1 class="text-center mb-4 mt-3">Entregas</h1>
		<table class="table table-hover table-light">
			<thead>
				<tr>
					<th>Data</th>
					<th>Nome</th>
					<th>Opções</th>
				</tr>
			</thead>
			<tbody id="tableBody">
					<?php
						mostrarEntregas(getEntregasPendentes());
					?>
			</tbody>
		</table>
	</div>

<?php
	include("./modelos/footer.php");
?>

<script>
	var tableEntregas = $("#tableBody");

	$(".cancelarBtn").click(function(){
		let idEntrega = $(this).parent().attr('id');
		trocarStatusEntrega(idEntrega, 2);
	});

	$(".concluirBtn").click(function(){
		let idEntrega = $(this).parent().attr('id');
		trocarStatusEntrega(idEntrega, 1);
	});

	function trocarStatusEntrega(id, status){
		$.ajax({
			url: './modulos/entregas.php',
			type: 'GET',
			data: {
				action: '1',
				id: id,
				status: status,
			},
		})
		.done(function(response) {
			let msg = JSON.parse(response);
			if(msg.status=="OK"){
				alert("A entrega foi atualizada!");
				document.location.reload();
			}
		})
		.fail(function() {
			alert("ERRO! Contate com o administrador.");
		})
		
		
	}
</script>
<script type="text/javascript" src="./modulos/cookiemanager.js"></script>
<script src="./modulos/checkar-login.js"></script>