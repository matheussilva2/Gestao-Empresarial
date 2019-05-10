<?php
	function converterData($string){
		return implode('/',array_reverse(explode('-', $string)));
	}

	function mostrarEntregas($entregas)
	{
		for ($i=0; $i < sizeof($entregas); $i++) { 
				echo '
					<tr class="stock-row">
						<td>'.converterData($entregas[$i]['data']).'</td>
						<td>'.($entregas[$i]['nome']).'</td>
						<td>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#info-entrega'.$entregas[$i]['id'].'">
								Ver Mais
							</button>
						</td>
					</tr>
					<div id="info-entrega'.$entregas[$i]['id'].'" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">
										Informações da Entrega
									</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<p>
										<strong>Vendedor</strong>: '.($entregas[$i]['vendedor']).'<br>
										<strong>Cliente</strong>: '.($entregas[$i]['nome']).'<br>
										<strong>Hotel</strong>: '.($entregas[$i]['hotel']).'<br>
										<strong>Quarto</strong>: '.($entregas[$i]['quarto']).'<br>
										<strong>Telefone</strong>: '.($entregas[$i]['telefone']).'<br>
										<strong>Produtos</strong>: '.($entregas[$i]['produto']).'<br>
										<strong>Endereço</strong>: '.($entregas[$i]['endereco']).'
									</p>
								</div>
								<div id='.$entregas[$i]['id'].' class="modal-footer">
									<button id="concluirEntregaBtn" type="button" class="concluirBtn btn btn-success" data-dismiss="modal">Concluir Entrega</button>

									<button id="cancelarEntregaBtn" type="button" class="cancelarBtn btn btn-danger" data-dismiss="modal">Cancelar Entrega</button>
								</div>
							</div>
						</div>
					</div>
				';
		}
	}
?>