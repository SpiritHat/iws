<?php
require_once "conexion.php"; // Asegúrate de incluir la conexión a la base de datos aquí

if (isset($_GET['id_u'])) {
    $id_usuario = $_GET['id_u'];

    // Consulta SQL para obtener los valores actuales del usuario
    $sql = "SELECT * FROM usuario WHERE id_u = :id_u";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_u', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        // Usuario no encontrado, puedes mostrar un mensaje de error o redirigir
        echo "Usuario no encontrado.";
    } else {
        // Aquí construye el formulario para la modificación
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modificar Usuario</title>
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
        <h1>Modificar Usuario</h1>
        <form action="ingreso_dmu.php" method="POST">
            <input type="hidden" name="id_u" value="<?php echo $usuario['id_u']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>">
            <label for="clave">Clave:</label>
            <input type="text" id="clave" name="clave" value="<?php echo $usuario['clave']; ?>">

        
            
            <label>Rol</label>
<select class="form-control" id="rol" name="rol">
    <?php
    $sentencia = "SELECT * FROM rol";
    $resultado = $conexion->query($sentencia) or die(mysqli_error($conexion));

    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        // Comprueba si el valor actual del bucle coincide con el rol del usuario
        $selected = ($fila['id_r'] == $usuario['rol']) ? 'selected' : '';
        
        echo "<option value='" . $fila['id_r'] . "' $selected>" . $fila['Descripcion'] . "</option>";
    }
    ?>
</select>


            <!-- Agrega más campos según sea necesario -->

            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>
</html>
<?php
    }
} else {
    // No se proporcionó un ID de usuario válido
    echo "ID de usuario no válido.";
}
?>
