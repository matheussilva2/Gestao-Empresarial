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
$(document).ready();