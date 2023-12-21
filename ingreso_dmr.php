<?php 
 $id_r = $_REQUEST['id_r'];
	 $Descripcion = $_REQUEST['Descripcion'];

	


		include 'conexion.php';
		$sentencia="UPDATE rol SET Descripcion='$Descripcion' WHERE id_r=$id_r";
		$conexion->query($sentencia) or die ("Error al actualizar datos".mysqli_error($conexion));

	
?>


<script type="text/javascript">
	alert("Datos Actualizados Exitosamante!!");
	window.location.href='panel_control.php';
</script>