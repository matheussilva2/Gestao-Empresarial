<?php

function converterData($string){
	return implode('/',array_reverse(explode('-', $string)));
}

?>