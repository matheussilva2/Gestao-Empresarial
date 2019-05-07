<?php
	function mostrarTodasEntregas($entregas) 
	{
		for ($i=0; $i < sizeof($entregas); $i++) { 
				echo '
						<tr class="stock-row">
						<td>
							<div class="dropdown">
								<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
									<i class="fas fa-caret-down"></i>
								</button>
								<div class="dropdown-menu">
									<ul>
										<li><i class="fas fa-trash-alt"></i></li>	
										<li><i class="fas fa-trash-alt"></i></li>	
										<li><i class="fas fa-window-close"></i></li>	
										<li><i class="fas fa-check-circle"></i></li>	
									</ul>
								</div>
							</div>
						</td>
							<td>'.($entregas[$i]['data']).'</td>
							<td>'.($entregas[$i]['nome']).'</td>
							<td>'.($entregas[$i]['telefone']).'</td>
							<td>'.($entregas[$i]['hotel']).'</td>
							<td>'.($entregas[$i]['quarto']).'</td>
							<td>'.($entregas[$i]['endereco']).'</td>
							<td>'.($entregas[$i]['vendedor']).'</td>
							<td>'.($entregas[$i]['produto']).'</td>
						</tr>
				';
		}
	}
?>