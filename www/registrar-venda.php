<?php
	require_once('./modulos/colaborador.php');
	require_once('./modulos/produto.php');
	$colaboradores = procurarTodosColaboradores();
	$produtos = procurarTodosProdutos();
?>
<?php
	include('./modelos/header.php');
?>
			
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