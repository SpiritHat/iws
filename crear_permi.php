<?php
  include "conexion.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrar Permiso</title>
<style type="text/css">
@import url("css/mycss.css");
</style>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">

  		<span> <h1>Registrar permiso</h1> </span>
  		<br>
	  <form action="ingresar_permi.php" method="POST" >

      <label>Permiso: </label>
      <input class="form-control" type="text" id="Descripcion" name="Descripcion"><br>  
</select>

  		<br>

  		<button type="submit" class="btn btn-success">Guardar</button>
     </form>
  
</div>
</body>
</html>