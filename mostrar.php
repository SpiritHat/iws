
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
       
        <th>Id_usuario</th>
        <th>Nombre</th>
        <th>Clave</th>
        <th>Rol</th>
       
      
        <th> <a href="panel_control.php"> <button type="button" class="btn btn-light">Menu</button></th>
      </thead>

      <?php
        include "conexion.php";
        $sentecia="SELECT * FROM usuario";
        $resultado= $conexion->query($sentecia) or die (mysqli_error($conexion));
       
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) 
        {
          
          echo "<tr>";
          
          echo "<td>"; echo $fila['id_u']; echo "</td>";
           echo "<td>"; echo $fila['nombre']; echo "</td>";          
          echo "<td>"; echo $fila['clave']; echo "</td>";
          echo "<td>"; echo $fila['rol']; echo "</td>";

          echo "</tr>";
        }
      ?>
      
    </table>

</div>


</body>
</html>