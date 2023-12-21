<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['clave'])) {
    header("Location: login.html"); // Redirige al usuario al login si no está autenticado
    exit();
}

// Verifica el rol del usuario
require_once "cors.php";
require_once "conexion.php"; // Asegúrate de incluir la conexión a la base de datos aquí

$clave = $_SESSION['clave'];

$sql = "SELECT U.rol, U.id_u
        FROM usuario U
        WHERE U.clave = :clave";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':clave', $clave, PDO::PARAM_INT);
$stmt->execute();

$roles = [];
$id_usuario = null;

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $roles[] = $row['rol'];
    $id_usuario = $row['id_u'];
}

// Obtén los permisos del usuario
$sql2 = "SELECT ap.id_permiso
        FROM asig_permisos ap
        WHERE ap.id_usuario = :id_usuario";

$stmt2 = $conexion->prepare($sql2);
$stmt2->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt2->execute();

$permisos = [];

while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $permisos[] = $row['id_permiso'];
}

$esAdministrador = in_array(1, $roles); // Si el ID_Rol '1' (Administrador) está en el array de roles, es un administrador
$esVendedor = in_array(2, $roles);

$permiso1 = in_array(1, $permisos); // Verifica si el usuario tiene el permiso 1
$permiso5 = in_array(5, $permisos);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Control</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?>!</h1>

    <h2>Opciones:</h2>
    <ul>
        <?php if ($esAdministrador && $permiso1): ?>
            <li><a href="mostrar.php">Visualizar usuarios</a></li>
            <li><a href="reg_u.php">Crear usuario</a></li>
            <li><a href="crear_usuario.php">Edición usuario</a></li>
            <li><a href="crear_usuario.php">Eliminar usuario</a></li>
            <li><a href="otorgar_permiso.php">Asignación permisos</a></li>
            <li><a href="crear_rol.php">Crear rol</a></li>
            <li><a href="mostrar_rol.php">Visualizar rol</a></li>
            <li><a href="crear_permi.php">Crear permisos</a></li>
            <li><a href="mostrar_permi.php">Visualizar permisos</a></li>
        <?php endif; ?>
        
        <?php if ($esVendedor && $permiso5): ?>
            <li><a href="vender.php">Vender</a></li>
        <?php endif; ?>
        <!-- Otros enlaces basados en los permisos del usuario -->
    </ul>
</body>
</html>
