<?php
	include("./modelos/header.php");
	require_once('modulos/colaborador.php');
	
	$colaborador = getUserByToken($_COOKIE['_session']);
	$hoje = date('Y-m-d');

	$vendasAnual = [];
	$vendasMensal = [];

	for ($i=1; $i <= 12; $i++) { 
		array_push($vendasAnual, getQuantidadeVendas($colaborador['matricula'],date('Y-').$i.'-01',date('Y-').$i.date('-t'))['quantidade']);
	}
	
	$vendasMensal = getVendasMensais(date('m'),$colaborador['matricula']);

	function getVendasMensais($mes, $matricula){
		$vendas = [];
		for($i=1;$i <= 31;$i++){
			array_push($vendas, getQuantidadeVendas($matricula,date('Y').'-'.$mes.'-'.$i,date('Y').'-'.$mes.'-'.$i)['quantidade']);
		}
		return $vendas;
	}


	function subtrairData($dataInicial, $dias){
		$dataInicial->sub(new DateInterval('P'.$dias.'D'));
		return $dataInicial->format('Y-m-d');
	}
?>
<div class="container-fluid bg-white pt-3 pb-1">
	<p class="text-center mb-4 font-weight-bold">Minhas Vendas</p>
</div>
<div class="container-fluid">
	<div>
		<div class="container m-0 bg-white py-3">
			<p class="font-weight-bold h5 text-left">Lucro do Mês</p>
			<p class="text-right font-weight-bold h4">
				<?php
					echo'R$'.
					getQuantidadeVendas(
						$colaborador['matricula'],
						substr($hoje, 0,7).'-01',$hoje)['valor'];
				?>
			<p>
		</div>
		<div class="container m-0 py-3 bg-white mt-3">
			<span>Total de Vendas</span>
			<p class="text-right h4">
				<?php
					echo'R$'.
					getQuantidadeVendas(
						$colaborador['matricula'],
						substr($hoje, 0,7).'-01',$hoje)['valor'];
				?>
			</p>
		</div>
		<div class="container m-0 py-3 bg-white mt-3">
			<span>Total de Vendas no Mês</span>
			<p class="text-right h4">
				<?php
					echo getQuantidadeVendas(
						$colaborador['matricula'],
						substr($hoje, 0,7).'-01',$hoje)['quantidade'];
				?>
			</p>
		</div>
	</div>

	<div class="container m-0 py-3 bg-white mt-3">
		<h2 class="mb-3">Vendas no Ano</h2>
		<canvas id="vendasAnual"></canvas>
	</div>
	<div class="container m-0 py-3 bg-white mt-3">
		<h2 class="mb-3">Vendas no Mês</h2>
		<canvas id="vendasMensal"></canvas>
	</div>
</div>
<script src="./modulos/cookiemanager.js"></script>
<script>
	if(getCookie('_session') != false){
		validarCookie(getCookie('_session'));
	}else{
		window.location.href = './login.php'
	}
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
	var graficoVendasCtx = document.getElementById("vendasAnual").getContext('2d');
	var graficoVendas = new Chart(graficoVendasCtx,{
		type: 'bar',

		data:{
			labels:['Janeiro','Fevereiro','Março','abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			datasets: [{
				label: 'Vendas',
				backgroundColor:'rgb(255, 99, 132)',
				borderColor: 'rgb(255, 99, 132)',
				data: <?php echo json_encode($vendasAnual);?>,
			}]
		}
	});
</script>
<script>
	var graficoVendasCtx = document.getElementById("vendasMensal").getContext('2d');
	var graficoVendas = new Chart(graficoVendasCtx,{
		type: 'bar',

		data:{
			labels:['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'],
			datasets: [{
				label: 'Vendas',
				backgroundColor:'rgb(255, 99, 132)',
				borderColor: 'rgb(255, 99, 132)',
				data: <?php echo json_encode($vendasMensal); ?>
			}]
		}
	});
</script>
<?php
	include("./modelos/footer.php");
?>