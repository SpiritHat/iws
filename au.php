<?php
require_once "cors.php";

try {
    require_once "conexion.php";

    // Obtener las credenciales ingresadas por el usuario
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];

    // Consulta preparada para verificar las credenciales en la base de datos
    $sql = "SELECT * FROM usuario WHERE nombre = :nombre AND clave = :clave";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':clave', $clave, PDO::PARAM_STR);
   
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Autenticación exitosa
        session_start();
       
        $_SESSION['clave'] = $clave;
        $_SESSION['nombre'] = $nombre;
        echo "success";
    } else {
        // Autenticación fallida
        echo "error";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
