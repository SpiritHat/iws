<?php
  include "conexion.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrar empleado</title>
<style type="text/css">
@import url("css/mycss.css");
</style>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">

  		<span> <h1>Registrar empleado</h1> </span>
  		<br>
	  <form action="ingresar_u.php" method="POST" >

      <label>Nombre: </label>
      <input class="form-control" type="text" id="nombre" name="nombre"><br>

      <label>Clave: </label>
      <input class="form-control" type="int" id="clave" name="clave"><br>

<label>Rol </label>
<select class="form-control" id="rol" name="rol">
<?php
$sentencia = "SELECT * FROM rol";
$resultado = $conexion->query($sentencia)or die(mysqli_error($conexion));

while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) 
 {
echo "<option value='".$fila['id_r']."'>".$fila['Descripcion']."</option>";
}

?>



</select>
    

      

  		<br>
  		<button type="submit" class="btn btn-success">Guardar</button>
     </form>
  
</div>
</body>
</html>