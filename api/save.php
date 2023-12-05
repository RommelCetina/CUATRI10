<?php
//conexion
$host = 'localhost';
$usuario = 'root';
$clave = '';
$bd ='cuatri_10';
$conexion = mysqli_connect($host, $usuario, $clave, $bd);
$_POST = json_decode(file_get_contents('php://input'),true);

$bandMsgInsert = '';
if ( isset($_POST['nombre']) and isset($_POST['ape_paterno']) and isset($_POST['ape_materno']) and isset($_POST['edad']) ){
	$nombre = $_POST['nombre'];
	$apePaterno = $_POST['ape_paterno'];
	$apeMaterno = $_POST['ape_materno'];
	$edad = $_POST['edad'];
	$estatus = $_POST['estatus'];

	
	//calculando calificaciones,promedios
	//asignando materias, maestro.
	//...
	if ( $edad < 37 ){
		$bandMsgInsert = '<div id="msgInsert" align="center"><b><small>ERROR: edad fuera de limite</small></b></div><br>';
	}else{
		$sql = "INSERT INTO alumnos (nombre,ape_paterno,ape_materno,edad,estatus) 
				VALUES ('$nombre','$apePaterno','$apeMaterno','$edad','$estatus')";
		$conexion->query($sql);
		
	}
	
	
}

echo json_encode (['code'=>200]);
?>