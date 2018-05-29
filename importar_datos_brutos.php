<?php
//CONEXION A LA BBDD
$numero_linea = 1;
$fp = fopen("conf.txt", "r");

$url = "localhost";
$login = "root";
$password = "";
$base_datos = "BD_EMPRESAS";

while(!feof($fp)) {
	$linea = fgets($fp);
	echo $linea . "\n";
	if ($numero_linea < 5) {
		list($variable, $valor) = explode('=', $linea);
		$valor = trim($valor);
		echo "Variable: $variable; Valor: '$valor'\n";
		if ($numero_linea == 1) {
			$url = $valor;
		}
		if ($numero_linea == 2) {
			$login = $valor;
		}
		if ($numero_linea == 3) {
			$password = $valor;
		}
		if ($numero_linea == 4) {
			$base_datos = $valor;
		}
		$numero_linea++;
	}
}
fclose($fp);

$conn = new mysqli("$url", "$login", "$password", "$base_datos");
$conn->query("SET NAMES utf8");

$linea = 0;
//Abrimos nuestro archivo
$archivo = fopen("/home/juanpfc/2016_cens_locals_plantabaixa.csv", "r");

//Lo recorremos
while (($datos = fgetcsv($archivo, ",")) == true) {
	$num = count($datos);
	$linea++;
	// La cabecera la obviamos	  
	if ($linea > 1) { 
		//Recorremos las columnas de esa linea
		for ($columna = 0; $columna < $num; $columna++) {
			//Limpiamos los datos que vienen
			$datos[$columna] = trim ( $datos[$columna] , " \t\n\r\0\x0B" );
			//los datos vacios que no sean un número los ponemos a null
			if ( empty($datos[$columna]) and  $datos[$columna] != 0) {
				$datos[$columna] = "null";
			}
			//las columnas vacias a null 
			if ($datos[$columna] == "") {
				$datos[$columna] = "null";
			}
			//todas las Strings que no sean null con comillas simples y las que contengan este caracter se escapan
			if (!is_numeric ($datos[$columna]) or $columna == 18) {			
				if ($datos[$columna] != "null") {
					$datos[$columna] = str_replace("'", "''", $datos[$columna]);	
					$datos[$columna] = "'" . $datos[$columna] . "'";
				}
			}			
		}
		//Caso especial con error en la fecha
		if ($datos[0] == 4215 or $datos[0] == 4216 or $datos[0] == 4217
		    or $datos[0] == 4218 or $datos[0] == 4219 or $datos[0] == 4220
		    or $datos[0] == 4223 or $datos[0] == 4224 or $datos[0] == 4225
		    or $datos[0] == 4226 or $datos[0] == 4227 or $datos[0] == 3608) {
			$datos[22] = "current_timestamp";
		}		 
		$sql = "INSERT INTO DATOS_BRUTOS (ID_BCN,ID_PRINCIP,N_PRINCIP,ID_SECTOR,N_SECTOR,ID_GRUPACT,N_GRUPACT,ID_ACT,N_ACT,N_LOCAL,SN_CARRER,SN_MERCAT,ID_MERCAT,N_MERCAT,SN_GALERIA,N_GALERIA,SN_CCOMERC,ID_CCOMERC,N_CCOMERC,N_CARRER,NUM_POLICI,REF_CAD,DATA,Codi_Barri,Nom_Barri,Codi_Districte,N_DISTRI,N_EIX ,SN_EIX,SEC_CENS,Y_UTM_ETRS,X_UTM_ETRS,LATITUD,LONGITUD)
		VALUES ($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7],$datos[8],$datos[9],
		$datos[10],$datos[11],$datos[12],$datos[13],$datos[14],$datos[15],$datos[16],$datos[17],$datos[18],$datos[19],
		$datos[20],$datos[21],$datos[22],$datos[23],$datos[24],$datos[25],$datos[26],$datos[27],$datos[28],$datos[29],$datos[30],$datos[31],$datos[32],$datos[33])
		";
		//$result = $conn->query($sql);
	
		if ($conn->query($sql) === TRUE) {
			echo "Insert Correcto\n";
		} 
		else {
			echo "Error: " . $sql . "\n" . $conn->error;
			exit;
		}
    }
}
//Cerramos el archivo
fclose($archivo);
//cerramos la conexión a la BBDD
$conn->close();	
?>
