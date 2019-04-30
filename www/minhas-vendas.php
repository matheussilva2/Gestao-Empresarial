<?php
	include("./modelos/header.php");
?>
<div class="container-fluid bg-white pt-3 pb-1">
	<p class="text-center mb-4 font-weight-bold">Minhas Vendas</p>
</div>
<div class="container-fluid">
	<div>
		<div class="container m-0 bg-white py-3">
			<p class="font-weight-bold h5 text-left">Lucro do Mês</p>
			<p class="text-right font-weight-bold h4">R$1435,00<p>
		</div>
		<div class="container m-0 py-3 bg-white mt-3">
			<span>Total de Vendas</span>
			<p class="text-right h4">9143</p>
		</div>
	</div>

	<div class="container m-0 py-3 bg-white mt-3">
		<h2 class="mb-3">Vendas no Ano</h2>
		<canvas id="vendasAnual"></canvas>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
	var graficoVendasCtx = document.getElementById("vendasAnual").getContext('2d');
	var graficoVendas = new Chart(graficoVendasCtx,{
		type: 'horizontalBar',

		data:{
			labels:['Janeiro','Fevereiro','Março','abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			datasets: [{
				label: 'Vendas',
				backgroundColor:'rgb(255, 99, 132)',
				borderColor: 'rgb(255, 99, 132)',
				data: [0,10,20,30,15,23,60]
			}]
		}
	});
</script>
<?php
	include("./modelos/footer.php");
?>