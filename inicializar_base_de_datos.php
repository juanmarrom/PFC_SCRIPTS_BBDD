<?php

function preparar_valor($valor_entrada) {
	$valor = $valor_entrada;
	if ( empty($valor) and $valor != 0) {
		$valor = "null";
	}
	//las columnas vacias a null 
	if ($valor == "") {
		$valor = "null";
	}				
	if ($valor != "null") {
		$valor = str_replace("'", "''", $valor);	
		$valor = "'" . $valor . "'";
	}	
    return $valor;
}

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

/*
//SECTOR
$sql = "select N_SECTOR FROM DATOS_BRUTOS GROUP BY N_SECTOR;";
$result = $conn->query($sql);
$id_tabla = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_tabla: " . $id_tabla . " - N_SECTOR: " . $row["N_SECTOR"]. "\n";
		$valor = preparar_valor($row["N_SECTOR"]);
		if ($valor != "null") {
			//INSERT
			$sql_insert = "INSERT INTO SECTOR (ID_SECTOR, NOMBRE, ID_IDIOMA) VALUES ($id_tabla, $valor, 2);";
			echo "$sql_insert\n";
				
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			$id_tabla++;	
		}								
    }
} 
else {
    echo "Consulta sin resultados";
}

////////////////////GRUPO ACTIVIDAD
$sql = "select N_GRUPACT FROM DATOS_BRUTOS GROUP BY N_GRUPACT;";
$result = $conn->query($sql);
$id_tabla = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_tabla: " . $id_tabla . " - N_GRUPACT: " . $row["N_GRUPACT"]. "\n";
		$valor = preparar_valor($row["N_GRUPACT"]);
		if ($valor != "null") {
			//INSERT
			$sql_insert = "INSERT INTO GRUPO_ACTIVIDAD (ID_GRUPO_ACTIVIDAD, NOMBRE, ID_IDIOMA) VALUES ($id_tabla, $valor, 2);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			$id_tabla++;	
		}								
    }
} 
else {
    echo "Consulta sin resultados";
}

////////////////////ACTIVIDAD
$sql = "select N_ACT, (SELECT ID_GRUPO_ACTIVIDAD FROM GRUPO_ACTIVIDAD DB2 WHERE DB2.NOMBRE = MAX(DB1.N_GRUPACT)) as ID_GRUPO_ACTIVIDAD FROM DATOS_BRUTOS DB1 GROUP BY N_ACT;";
$result = $conn->query($sql);
$id_tabla = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_tabla: " . $id_tabla . " - N_ACT: " . $row["N_ACT"]. "\n";
		$valor = preparar_valor($row["N_ACT"]);
		$id_grupo = $row["ID_GRUPO_ACTIVIDAD"];
		if ($valor != "null") {
			//INSERT
			$sql_insert = "INSERT INTO ACTIVIDAD (ID_ACTIVIDAD, NOMBRE, ID_GRUPO_ACTIVIDAD, ID_IDIOMA) VALUES ($id_tabla, $valor, $id_grupo, 2);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			$id_tabla++;	
		}								
    }
} 
else {
    echo "Consulta sin resultados";
}
*/

/*
////////////////////DISTRITO
$sql = "SELECT N_DISTRI FROM DATOS_BRUTOS GROUP BY N_DISTRI;";
$result = $conn->query($sql);
$id_tabla = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_tabla: " . $id_tabla . " - N_DISTRI: " . $row["N_DISTRI"]. "\n";
		$valor = preparar_valor($row["N_DISTRI"]);
		if ($valor != "null") {
			//INSERT LENGUA 1
			$sql_insert = "INSERT INTO DISTRITO (ID_DISTRITO, NOMBRE, ID_IDIOMA, ID_CIUDAD) VALUES ($id_tabla, $valor, 1, 1);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			//INSERT LENGUA 2
			$sql_insert = "INSERT INTO DISTRITO (ID_DISTRITO, NOMBRE, ID_IDIOMA, ID_CIUDAD) VALUES ($id_tabla, $valor, 2, 1);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}			
			$id_tabla++;	
		}								
    }
} 
else {
    echo "Consulta sin resultados";
}


////////////////////BARRIO
$sql = "select NOM_BARRI, (SELECT ID_DISTRITO FROM DISTRITO DB2 WHERE DB2.NOMBRE = MAX(DB1.N_DISTRI) and ID_IDIOMA=2) as ID_DISTRITO FROM DATOS_BRUTOS DB1 GROUP BY NOM_BARRI;";
$result = $conn->query($sql);
$id_tabla = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_tabla: " . $id_tabla . " - NOM_BARRI: " . $row["NOM_BARRI"]. "\n";
		$valor = preparar_valor($row["NOM_BARRI"]);
		$id_grupo = $row["ID_DISTRITO"];
		if ($valor != "null") {
			//INSERT LENGUA 1
			$sql_insert = "INSERT INTO BARRIO (ID_BARRIO, ID_IDIOMA, NOMBRE, ID_DISTRITO) VALUES ($id_tabla, 1, $valor, $id_grupo);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			//INSERT LENGUA 2
			$sql_insert = "INSERT INTO BARRIO (ID_BARRIO, ID_IDIOMA, NOMBRE, ID_DISTRITO) VALUES ($id_tabla, 2, $valor, $id_grupo);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			
			$id_tabla++;	
		}								
    }
} 
else {
    echo "Consulta sin resultados";
}


////////////////////CALLE
$sql = "SELECT N_CARRER, (SELECT ID_BARRIO FROM BARRIO WHERE NOMBRE = NOM_BARRI AND ID_IDIOMA = 2) as ID_BARRIO FROM (
SELECT N_CARRER, NOM_BARRI FROM DATOS_BRUTOS GROUP BY N_CARRER, NOM_BARRI
) foo;";
$result = $conn->query($sql);
$id_tabla = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_tabla: " . $id_tabla . " - N_CARRER: " . $row["N_CARRER"]. "\n";
		$valor = preparar_valor($row["N_CARRER"]);
		$id_grupo = $row["ID_BARRIO"];
		if ($valor != "null") {
			//INSERT
			$sql_insert = "INSERT INTO CALLE (NOMBRE, ID_BARRIO) VALUES ($valor, $id_grupo);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			$id_tabla++;	
		}								
    }
} 
else {
    echo "Consulta sin resultados";
}
*/

//NUMERO_CALLE
/*$sql = "SELECT (SELECT ID FROM CALLE WHERE NOMBRE = N_CARRER AND ID_BARRIO = ID_BARR) as ID_CALLE, NUM_POLICI, LAT, LONGI FROM (
SELECT N_CARRER, (SELECT ID_BARRIO FROM BARRIO WHERE NOMBRE = NOM_BARRI AND ID_IDIOMA = 2) as ID_BARR, NUM_POLICI, LAT, LONGI FROM (
SELECT N_CARRER, NOM_BARRI, NUM_POLICI, TRUNCATE(AVG(LATITUD), 7) as LAT, TRUNCATE(AVG(LONGITUD), 7) as LONGI FROM DATOS_BRUTOS GROUP BY N_CARRER, NOM_BARRI, NUM_POLICI
) foo ) foo2;";
$result = $conn->query($sql);
$id_tabla = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_tabla: " . $id_tabla . " - ID_CALLE: " . $row["ID_CALLE"]. "\n";
		$valor = preparar_valor($row["NUM_POLICI"]);
		$id_grupo = $row["ID_CALLE"];
		$latitud = $row["LAT"];
		$logitud = $row["LONGI"];
		if ($valor != "null") {
			//INSERT
			$sql_insert = "INSERT INTO NUMERO_CALLE (NOMBRE, ID_CALLE, LATITUD, LONGITUD) VALUES ($valor, $id_grupo,$latitud,$logitud);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			$id_tabla++;	
		}								
    }
} 
else {
    echo "Consulta sin resultados";
}
*/

////////////C COMERCIAL
/*
$sql = "Select N_CCOMERC, N_DISTRI, CONCAT(N_DISTRI, ' ', NOM_BARRI, ' ', N_CARRER, ' ', NUM_POLICI), (Select ID_DISTRITO from DISTRITO where NOMBRE = N_DISTRI AND ID_IDIOMA = 2) as ID_DISTRITO, (Select ID_BARRIO from BARRIO where NOMBRE = NOM_BARRI AND ID_IDIOMA = 2) as ID_BARRIO,
(Select ID from CALLE where NOMBRE = N_CARRER AND ID_BARRIO IN (Select ID_BARRIO from BARRIO where NOMBRE = NOM_BARRI AND ID_IDIOMA = 2)) AS ID_CALLE, 
(Select ID from NUMERO_CALLE where NOMBRE = NUM_POLICI AND ID_CALLE in (Select ID from CALLE where NOMBRE = N_CARRER AND ID_BARRIO IN (Select ID_BARRIO from BARRIO where NOMBRE = NOM_BARRI AND ID_IDIOMA = 2))) as ID_NUM_CALLE FROM (
SELECT N_CCOMERC, N_DISTRI, NOM_BARRI, N_CARRER, NUM_POLICI FROM DATOS_BRUTOS WHERE SN_CCOMERC > 0 GROUP BY N_CCOMERC, N_DISTRI, NOM_BARRI, N_CARRER, NUM_POLICI
) foo;";
$result = $conn->query($sql);
$id_tabla = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_tabla: " . $id_tabla . " - N_CCOMERC: " . $row["N_CCOMERC"]. "\n";
		$valor = preparar_valor($row["N_CCOMERC"]);
		$id_distrito = $row["ID_DISTRITO"];
		$id_barrio = $row["ID_BARRIO"];
		$id_calle = $row["ID_CALLE"];
		$id_ncalle = $row["ID_NUM_CALLE"];
		if ($valor != "null") {
			//INSERT
			$sql_insert = "INSERT INTO CENTRO_COMERCIAL (NOMBRE, ID_CIUDAD, ID_DISTRITO, ID_BARRIO, ID_CALLE, ID_NUMERO_CALLE) 
												VALUES ($valor, 1, $id_distrito,$id_barrio,$id_calle,$id_ncalle);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			$id_tabla++;	
		}								
    }
} 
else {
    echo "Consulta sin resultados";
}*/


//////////////////GALERIA
$sql = "Select N_GALERIA, N_DISTRI, CONCAT(N_DISTRI, ' ', NOM_BARRI, ' ', N_CARRER, ' ', NUM_POLICI), (Select ID_DISTRITO from DISTRITO where NOMBRE = N_DISTRI AND ID_IDIOMA = 2) as ID_DISTRITO, (Select ID_BARRIO from BARRIO where NOMBRE = NOM_BARRI AND ID_IDIOMA = 2) as ID_BARRIO,
(Select ID from CALLE where NOMBRE = N_CARRER AND ID_BARRIO IN (Select ID_BARRIO from BARRIO where NOMBRE = NOM_BARRI AND ID_IDIOMA = 2)) AS ID_CALLE, 
(Select ID from NUMERO_CALLE where NOMBRE = NUM_POLICI AND ID_CALLE in (Select ID from CALLE where NOMBRE = N_CARRER AND ID_BARRIO IN (Select ID_BARRIO from BARRIO where NOMBRE = NOM_BARRI AND ID_IDIOMA = 2))) as ID_NUM_CALLE FROM (
SELECT N_GALERIA, N_DISTRI, NOM_BARRI, N_CARRER, NUM_POLICI FROM DATOS_BRUTOS WHERE SN_GALERIA > 0 GROUP BY N_GALERIA, N_DISTRI, NOM_BARRI, N_CARRER, NUM_POLICI
) foo;";
$result = $conn->query($sql);
$id_tabla = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_tabla: " . $id_tabla . " - N_GALERIA: " . $row["N_GALERIA"]. "\n";
		$valor = preparar_valor($row["N_GALERIA"]);
		$id_distrito = $row["ID_DISTRITO"];
		$id_barrio = $row["ID_BARRIO"];
		$id_calle = $row["ID_CALLE"];
		$id_ncalle = $row["ID_NUM_CALLE"];
		if ($valor != "null") {
			//INSERT
			$sql_insert = "INSERT INTO GALERIA (NOMBRE, ID_CIUDAD, ID_DISTRITO, ID_BARRIO, ID_CALLE, ID_NUMERO_CALLE) 
												VALUES ($valor, 1, $id_distrito,$id_barrio,$id_calle,$id_ncalle);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			$id_tabla++;	
		}								
    }
} 
else {
    echo "Consulta sin resultados";
}


//////////MERCADO
$sql = "Select N_MERCAT, N_DISTRI, CONCAT(N_DISTRI, ' ', NOM_BARRI, ' ', N_CARRER, ' ', NUM_POLICI), (Select ID_DISTRITO from DISTRITO where NOMBRE = N_DISTRI AND ID_IDIOMA = 2) as ID_DISTRITO, (Select ID_BARRIO from BARRIO where NOMBRE = NOM_BARRI AND ID_IDIOMA = 2) as ID_BARRIO,
(Select ID from CALLE where NOMBRE = N_CARRER AND ID_BARRIO IN (Select ID_BARRIO from BARRIO where NOMBRE = NOM_BARRI AND ID_IDIOMA = 2)) AS ID_CALLE, 
(Select ID from NUMERO_CALLE where NOMBRE = NUM_POLICI AND ID_CALLE in (Select ID from CALLE where NOMBRE = N_CARRER AND ID_BARRIO IN (Select ID_BARRIO from BARRIO where NOMBRE = NOM_BARRI AND ID_IDIOMA = 2))) as ID_NUM_CALLE FROM (
SELECT N_MERCAT, N_DISTRI, NOM_BARRI, N_CARRER, NUM_POLICI FROM DATOS_BRUTOS WHERE SN_MERCAT > 0 GROUP BY N_MERCAT, N_DISTRI, NOM_BARRI, N_CARRER, NUM_POLICI
) foo;";
$result = $conn->query($sql);
$id_tabla = 1;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_tabla: " . $id_tabla . " - N_MERCAT: " . $row["N_MERCAT"]. "\n";
		$valor = preparar_valor($row["N_MERCAT"]);
		$id_distrito = $row["ID_DISTRITO"];
		$id_barrio = $row["ID_BARRIO"];
		$id_calle = $row["ID_CALLE"];
		$id_ncalle = $row["ID_NUM_CALLE"];
		if ($valor != "null") {
			//INSERT
			$sql_insert = "INSERT INTO MERCADO (NOMBRE, ID_CIUDAD, ID_DISTRITO, ID_BARRIO, ID_CALLE, ID_NUMERO_CALLE) 
												VALUES ($valor, 1, $id_distrito,$id_barrio,$id_calle,$id_ncalle);";
			echo "$sql_insert\n";
					
			if ($conn->query($sql_insert) === TRUE) {
				echo "Insert Correcto\n";
			} 
			else {
				echo "Error: " . $sql . "\n" . $conn->error;
				exit;
			}
			$id_tabla++;	
		}								
    }
} 
else {
    echo "Consulta sin resultados";
}



//cerramos la conexión a la BBDD
$conn->close();	
?>
