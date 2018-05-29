<?php
$numero_linea = 1;
$fp = fopen("conf.txt", "r");
while(!feof($fp)) {
	$linea = fgets($fp);
	echo $linea . "\n";
	if ($numero_linea < 4) {
		$numero_linea++;
		list($variable, $valor) = explode('=', $linea);
		echo "Variable: $variable; Valor: $valor\n";
	}
}
fclose($fp);
?>
