<html>
<?php
//conexion
$host = 'localhost';
$usuario = 'root';
$clave = '';
$bd ='cuatri_10';
$conexion = mysqli_connect($host, $usuario, $clave, $bd);

$idAlumno = $_GET['idAlumno'];
$descripEstatus = array('1'=>'vigente','2'=>'no vigente');

$sql = "SELECT * FROM alumnos WHERE alumno_id = '$idAlumno'";
$resultado = $conexion->query($sql);
$fResultado = $resultado->fetch_assoc();
?>
	<body>
		<h2 align="center">Detalle del alumno</h2>
		<table width="80%" border="1" align="center">
			<tr>
				<td>Id: <?php echo $fResultado['alumno_id']; ?></td>
			</tr>
			<tr>
				<td>Nombre: <?php echo $fResultado['nombre']; ?></td>
			</tr>
			<tr>
				<td>Ape. Paterno: <?php echo $fResultado['ape_paterno']; ?></td>
			</tr>
			<tr>
				<td>Ape. Materno: <?php echo $fResultado['ape_materno']; ?></td>
			</tr>
			<tr>
				<td>Edad:<?php echo $fResultado['edad']; ?> años.</td>
			</tr>
			<tr>
				<td>Vigente: <?php echo $descripEstatus[ $fResultado['estatus'] ]; ?></td>
			</tr>
			<tr>
				<td align="center">
					<a href="alumnos.php"> regresar</a>
				</td>
			</tr>
		</table>
		
	</body>
</html>