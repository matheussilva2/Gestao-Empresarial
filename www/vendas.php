<?php
	include("./modelos/header.php");
	require_once('modulos/colaborador.php');
	
	checkarAutorizacao([ADMIN]);

	$colaborador = getUserByToken($_COOKIE['_session']);
	$colaboradores = procurarTodosColaboradores();

	$hoje = date('Y-m-d');

	$vendasAnual = getVendasAnuais('2019');
	$vendasMensal = getVendasMensais(date('m'));

	function getVendasAnuais($ano){
		$vendas = [];
		for ($i=1; $i <= 12; $i++) { 
			array_push($vendas, getTodasVendas($ano.'-'.$i.'-01',$ano.'-'.$i.date('-t'))['quantidade']);
		}
		return $vendas;
	}
	function converterLucro($v){
		return $v * 0.7;
	}
	function getVendasMensais($mes){
		$vendas = [];
		for($i=1;$i <= 31;$i++){
			array_push($vendas, getTodasVendas(date('Y').'-'.$mes.'-'.$i,date('Y').'-'.$mes.'-'.$i)['quantidade']);
		}
		var_dump($vendas);echo "<hr>";
		$vendas = array_map("converterLucro", $vendas);
		var_dump($vendas);
		return $vendas;
	}

	function filtrarVendasMensais($mes, $matricula){
		$vendas = [];
		for($i=1;$i <= 31;$i++){
			array_push($vendas,
				getQuantidadeVendas(date('Y').'-'.$mes.'-'.$i,date('Y').'-'.$mes.'-'.$i)['quantidade']
			);
		}
		array_map(function($v){$v *= 0.7;} , $vendas);
		return $vendas;
	}

	function subtrairData($dataInicial, $dias){
		$dataInicial->sub(new DateInterval('P'.$dias.'D'));
		return $dataInicial->format('Y-m-d');
	}
?>
<div class="container-fluid bg-white pt-3 pb-1 mb-3">
	<p class="h3 text-center mb-4 font-weight-bold">Vendas</p>
</div>
<div class="container-fluid">
	<div>
		<div class="container my-3">
			<select class='custom-control custom-select' id="colaborador-selecionado">
				<option value="0" selected>Todos</option>
				<?php
					for($i=0;$i<count($colaboradores);$i++){
						if($colaboradores[$i]['cargo'] == 'vendedor'){
							echo "
								<option value='".$colaboradores[$i]['matricula']."'>".$colaboradores[$i]['nome']."</option>
							";
						}
					}
				?>
			</select>
		</div>
		<div class="container m-0 bg-white py-3">
			<p class="text-left">Lucro do Mês</p>
			<p class="text-right h4">
				<?php
					echo 'R$'.
					getTodasVendas(substr($hoje, 0,7).'-01',$hoje)['valor']*0.7;
				?>
			<p>
		</div>
		<div class="container m-0 py-3 bg-white mt-3">
			<span>Total de Vendas no Mês</span>
			<p class="text-right h4">
				<?php
					echo getTodasVendas(substr($hoje, 0,7).'-01',$hoje)['quantidade'];
				?>
			</p>
		</div>
		<div class="container m-0 py-3 bg-white mt-3">
			<span>Lucro Total</span>
			<p class="text-right h4">
				<?php
					echo 'R$'.
					getTodasVendas('2000-01-01', '2100-01-01')['valor'];
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

<!-- SCRIPTS --> 
<?php
	include("./modelos/footer.php");
?>

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
	var vendasAnual = [];
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
	function atualizarVendasAnual(){
		vendasAnual = <?php echo json_encode($vendasAnual);?>;
	}
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
				data: <?php echo json_encode($vendasMensal);?>
			}]
		}
	});
	function atualizarVendasMensal(){
		vendasMensal = <?php echo json_encode($vendasMensal); ?>;
	}

	$("#colaborador-selecionado").bind('input', function(){
		atualizarVendasMensal();
	});

</script>