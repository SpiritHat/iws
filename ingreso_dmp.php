
<?php 
 $id_p = $_REQUEST['id_p'];
	 $Descripcion = $_REQUEST['Descripcion'];

	


		include 'conexion.php';
		$sentencia="UPDATE permisos SET Descripcion='$Descripcion' WHERE id_p=$id_p";
		$conexion->query($sentencia) or die ("Error al actualizar datos".mysqli_error($conexion));

	
?>


<script type="text/javascript">
	alert("Datos Actualizados Exitosamante!!");
	window.location.href='panel_control.php';
</script>