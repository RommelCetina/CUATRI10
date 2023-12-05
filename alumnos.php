<html>
<?php
//conexion
$host = 'localhost';
$usuario = 'root';
$clave = '';
$bd ='cuatri_10';
$conexion = mysqli_connect($host, $usuario, $clave, $bd);

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
		if ( $conexion->insert_id != 0 ){
			$bandMsgInsert = '<div id="msgInsert" align="center"><b><small>alumno agregado correctamente</small></b></div><br>';
		}else{
			$bandMsgInsert = '<div id="msgInsert" align="center"><b><small>ERROR</small></b></div><br>';
		}
	}
	
	
}

$descripEstatus = array('1'=>'vigente','2'=>'no vigente');
?>
<link rel="manifest" href="manifest.json">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<body>
		<h2 align="center">Listado de alumnos</h2>
		<table class = "table" width="80%" border="1" align="center">
			<tr>
				<td>Id</td>
				<td>Nombre</td>
				<td>Ape. Paterno</td>
				<td>Ape. Materno</td>
				<td>Edad</td>
				<td>Vigente</td>
				<td>Ver detalle</td>
			</tr>
<?php
			$sql = "SELECT * FROM alumnos ORDER BY alumno_id";
			$resultado = $conexion->query($sql);
			while( $fResultado = $resultado->fetch_assoc() ){
				echo'
				<tr>
					<td>'.$fResultado['alumno_id'].'</td>
					<td>'.$fResultado['nombre'].'</td>
					<td>'.$fResultado['ape_paterno'].'</td>
					<td>'.$fResultado['ape_materno'].'</td>
					<td>'.$fResultado['edad'].'</td>
					<td>'.$descripEstatus [ $fResultado['estatus'] ].'</td>
					<td><a href="detalle.php?idAlumno='.$fResultado['alumno_id'].'">ver detalle</a></td>
				</tr>';
			}			
?>			
		</table>
		<h2 align="center">Agregar alumno</h2>
<?php	echo $bandMsgInsert; ?>		
		<form name="form1" id="form1" action="alumnos.php" method="post">
			<table class ="table table-hover" width="80%" border="1" align="center">
				<tr>
					<td>Nombre</td>
					<td>Ape. Paterno</td>
					<td>Ape. Materno</td>
					<td>Edad</td>
					<td>Estatus</td>
				</tr>
				<tr>
					<td><input type="text" name="nombre" id="nombre"></td>
					<td><input type="text" name="ape_paterno" id="ape_paterno"></td>
					<td><input type="text" name="ape_materno" id="ape_materno"></td>
					<td><input type="text" name="edad" id="edad"></td>
					<td>
						<select name="estatus" id="estatus">
							<option value="1">Vigente</option>
							<option value="2">No vigente</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="4"><input class ="btn btn-primary" id = "btnS" type="submit" value="Guardar"></td>
				</tr>
			</table>
		</form>
		<video id="videoPreview" autoplay playsinline></video>
		
	</body>
	<script src="js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script>
		// Verificar si el navegador es compatible con la API de geolocalización
if (navigator.geolocation) {
    // Solicitar acceso a la ubicación
    navigator.geolocation.getCurrentPosition(
        function (position) {
            // El acceso a la ubicación fue exitoso, puedes acceder a la posición del usuario
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            console.log('Ubicación del usuario:', latitude, longitude);
        },
        function (error) {
            // Si hay un error al acceder a la ubicación, puedes manejarlo aquí
            console.error('Error al acceder a la ubicación:', error.message);
        }
    );
} else {
    // El navegador no es compatible con la API de geolocalización
    console.error('El navegador no es compatible con la API de geolocalización');
}


// Verificar si el navegador es compatible con la API de medios
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Solicitar acceso a la cámara
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
            // El acceso a la cámara fue exitoso, puedes usar el stream para mostrar la vista previa o realizar otras operaciones
            var videoElement = document.getElementById('videoPreview');
            videoElement.srcObject = stream;
        })
        .catch(function (error) {
            // Si hay un error al acceder a la cámara, puedes manejarlo aquí
            console.error('Error al acceder a la cámara:', error);
        });
} else {
    // El navegador no es compatible con la API de medios
    console.error('El navegador no es compatible con la API de medios');
}


	</script>
</html>