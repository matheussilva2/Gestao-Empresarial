<?php
	function mostrar_estoque($produtos){
		for ($i=0; $i < sizeof($produtos); $i++) { 
				echo '
					<tr class="stock-row">
						<td>'.($produtos[$i]['id']).'</td>
						<td>'.($produtos[$i]['nome']).'</td>
						<td>R$'.($produtos[$i]['preco_custo']).'</td>
						<td>R$'.($produtos[$i]['preco_venda']).'</td>
						<td>'.($produtos[$i]['quantidade']).'</td>
					</tr>
					';
		}
	}

?>