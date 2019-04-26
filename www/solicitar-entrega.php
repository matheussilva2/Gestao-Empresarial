<?php
	include('./modelos/header.php');
?>
<div class="container">
	<h1 class="h3 pt-3">Solicitação de Entrega</h1>
	<hr>
	<form>
		<label class="w-100">Nome completo</label><br>
		<input id="iNome" name="nome" type="text" class="w-100 mb-3"><br>
		<label class="w-100">Telefones</label><br>
		<input class="w-100 mb-3" type="text" id="iFone"><br>
		<label class="w-100">Hotel</label><br>
		<input class="w-100 mb-3" type="text" id="iHotel"><br>
		<label class="w-100">Quarto</label><br>
		<input class="w-100 mb-3" type="text" id="iQuarto"><br>
		<label class="w-100">Endereço</label><br>
		<input class="w-100 mb-3" type="text" id="iEndereco"><br>
		<button id="enviarBtn" type="button" class="btn btn-success w-100">Solicitar Entrega</button>
	</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$('#enviarBtn').click(function(){
			if(validarCampo('#iHotel')){
				let solicitacao = {
					nome: $('#iNome').val(),
					telefone: $('#iFone').val(),
					hotel: $('#iHotel').val(),
					quarto: $('#iQuarto').val(),
					endereco: $('#iEndereco').val(),
				}
				enviarSolicitacao(solicitacao);
			}
		});
	});
	function enviarSolicitacao(solicitacao){
		$.ajax({
			type: "POST",
			url: "./modulos/solicitar-entrega.php",
			data:{
				nome: solicitacao.nome,
				telefone: solicitacao.telefone,
				hotel: solicitacao.hotel,
				quarto: solicitacao.quarto,
				endereco: solicitacao.endereco,
			}
		})
	}
	function validarCampo(id){
		if($(id).val() != ''){
			return true;
		}else{return false;}
	}
	
</script>
<?php
	include('./modelos/footer.php');
?>