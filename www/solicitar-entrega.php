<?php
	include('./modelos/header.php');
?>
<div class="container pb-4">
	<h1 class="h3 pt-3">Solicitação de Entrega</h1>
	<hr>
	<div id="successNotification" style="display: none;" class="alert alert-success pt-2 pl-2 pb-1 mb-2 my-3">
		<button class="close" type="button" id="btnNotificationClose">&times;</button>
		<p><strong>Sucesso! </strong>A entrega foi solicitada!</p>
	</div>
	<form>
		<label class="w-100">Nome Completo</label><br>
		<input id="iNome" name="nome" type="text" class="w-100 mb-3"><br>
		<label class="w-100">Telefones</label><br>
		<input class="w-100 mb-3" type="text" id="iFone"><br>
		<label class="w-100">Hotel</label><br>
		<input class="w-100 mb-3" type="text" id="iHotel"><br>
		<label class="w-100">Quarto</label><br>
		<input class="w-100 mb-3" type="text" id="iQuarto"><br>
		<label class="w-100">Endereço</label><br>
		<input class="w-100 mb-3" type="text" id="iEndereco"><br>
		<label class="w-100">Produtos</label><br>
		<input class="w-100 mb-3" type="text" id="iProdutos"><br>
		<button id="enviarBtn" type="button" class="btn btn-success w-100">Solicitar Entrega</button>
	</form>
</div>
<?php
	include('./modelos/footer.php');
?>
<script src="./modulos/cookiemanager.js"></script>
<!-- Validar Cookie -->
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
				if(res['status']=='FALHA'){
					location.href="./login.php";
				}
			})
			.fail(function() {
				alert("Algo deu errado! Recarregue a página ou contate o administrador!");
			})
		}else{location.href="./login.php";}
	}
	validarCookie(getCookie('_session'));
</script>

<!-- Request da solicitação de entrega -->

<script>
	$(document).ready(function(){
		$("#btnNotificationClose").click(function(){
			$("#successNotification").slideUp('FAST');
		});
		$('#enviarBtn').click(function(){
			if(validarCampo('#iHotel')){
				let solicitacao = {
					nome: $('#iNome').val(),
					telefone: $('#iFone').val(),
					hotel: $('#iHotel').val(),
					quarto: $('#iQuarto').val(),
					endereco: $('#iEndereco').val(),
					produtos: $('#iProdutos').val(),
				}
				enviarSolicitacao(solicitacao);
			}
		});
	});
	function enviarSolicitacao(solicitacao){
		let cookieSessao = getCookie('_session');
		$.ajax({
			type: "POST",
			url: "./modulos/solicitar-entrega.php",
			data:{
				nome: solicitacao.nome,
				telefone: solicitacao.telefone,
				hotel: solicitacao.hotel,
				quarto: solicitacao.quarto,
				endereco: solicitacao.endereco,
				cookie: cookieSessao,
				produtos: solicitacao.produtos,
			},
			success: function($dados){
				var resposta = JSON.parse($dados);
				if(resposta['status']=="OK"){
					$("#successNotification").fadeIn();
				}
			}
		})

	}
	function validarCampo(id){
		if($(id).val() != ''){
			return true;
		}else{return false;}
	}
	
</script>