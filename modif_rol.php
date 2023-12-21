<?php
require_once "conexion.php"; // Asegúrate de incluir la conexión a la base de datos aquí

if (isset($_GET['id_r'])) {
    $id_re = $_GET['id_r'];

    // Consulta SQL para obtener los valores actuales del usuario
    $sql = "SELECT * FROM rol WHERE id_r = :id_r";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_r', $id_re, PDO::PARAM_INT);
    $stmt->execute();
    $permiso = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$permiso) {
        // Usuario no encontrado, puedes mostrar un mensaje de error o redirigir
        echo "Permiso no encontrado.";
    } else {
        // Aquí construye el formulario para la modificación
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modificar rol</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modificar rol</title>
<style type="text/css">
@import url("css/mycss.css");
</style>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <h1>Modificar rol</h1>
        <form action="ingreso_dmr.php" method="POST">
            <input type="hidden" name="id_r" value="<?php echo $permiso['id_r']; ?>">
            <label for="nombre">rol:</label>
            <input type="text" id="Descripcion" name="Descripcion" value="<?php echo $permiso['Descripcion']; ?>">
        
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
