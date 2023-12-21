<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['clave'])) {
    header("Location: login.html"); // Redirige al usuario al login si no está autenticado
    exit();
}

require_once "cors.php";
require_once "conexion.php"; // Asegúrate de incluir la conexión a la base de datos aquí

$clave = $_SESSION['clave'];

// Obtén el ID del usuario autenticado
$sql = "SELECT id_u FROM usuario WHERE clave = :clave";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':clave', $clave, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id_usuario = $row['id_u'];

// Verifica los permisos del usuario
$sql_permisos = "SELECT id_permiso FROM asig_permisos WHERE id_usuario = :id_usuario";
$stmt_permisos = $conexion->prepare($sql_permisos);
$stmt_permisos->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt_permisos->execute();

$tienePermisoEditar = false;
$tienePermisoEliminar = false;

while ($permiso = $stmt_permisos->fetch(PDO::FETCH_ASSOC)) {
    if ($permiso['id_permiso'] == 2) {
        $tienePermisoEditar = true;
    } elseif ($permiso['id_permiso'] == 3) {
        $tienePermisoEliminar = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tabla usuarios</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
  <table class="table table-dark table-borderless">
      <thead >
       
        <th>Id Rol</th>
        <th>Nombre</th>
       
      
        <th> <a href="panel_control.php"> <button type="button" class="btn btn-light">Menu</button></th>
      </thead>

      <?php
        include "conexion.php";
        $sentecia="SELECT * FROM rol";
        $resultado= $conexion->query($sentecia) or die (mysqli_error($conexion));
       
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) 
        {
          
          echo "<tr>";
          
          echo "<td>"; echo $fila['id_r']; echo "</td>";
           echo "<td>"; echo $fila['Descripcion']; echo "</td>";    

          if ($tienePermisoEliminar) {
            echo "<td><a href='eliminar_rol.php?id_r=".$fila['id_r']."'><button type='button' class='btn btn-danger'>Eliminar</button></a></td>";
         }
         if ($tienePermisoEditar) {
           echo "<td><a href='modif_rol.php?id_r=".$fila['id_r']."'><button type='button' class='btn btn-success'>Modificar</button></a></td>";
         }
         echo "</td>";
         echo "</tr>";
        }

        
      ?>
      
    </table>

</div>


</body>
</html>