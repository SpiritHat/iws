
<?php 
 $id_u = $_REQUEST['id_u'];
	 $nombre = $_REQUEST['nombre'];
	$clave = $_REQUEST['clave'];
	$rol = $_REQUEST['rol'];
	


		include 'conexion.php';
		$sentencia="UPDATE usuario SET nombre='$nombre', clave='$clave',rol='$rol'WHERE id_u=$id_u";
		$conexion->query($sentencia) or die ("Error al actualizar datos".mysqli_error($conexion));

	
?>


<script type="text/javascript">
	alert("Datos Actualizados Exitosamante!!");
	window.location.href='panel_control.php';
</script>