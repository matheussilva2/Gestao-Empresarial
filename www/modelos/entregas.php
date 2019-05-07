<?php
	function mostrarTodasEntregas($entregas) 
	{
		for ($i=0; $i < sizeof($entregas); $i++) { 
				echo '
					<tr class="stock-row">
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