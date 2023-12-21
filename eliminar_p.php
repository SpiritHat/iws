<?php
require_once "cors.php"; //este en todo php
require_once "conexion.php"; // Asegúrate de incluir la conexión a la base de datos aquí

try { //este en todo php
    require_once "conexion.php"; //este en todo php

if (isset($_GET['id_p'])) {
    $id_p = $_GET['id_p'];

    // Realiza una consulta SQL para eliminar el registro del permiso
    $sql = "DELETE FROM permisos WHERE id_p = :id_p";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_p', $id_p, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Eliminación exitosa
        header("Location: panel_control.php"); // Redirige a la página principal o donde desees después de eliminar
        exit();
    } else {
        // Error al eliminar
        echo "Error al eliminar el permiso.";
    }
} else {
    // No se proporcionó un ID del permiso válido
    echo "ID de permiso no válido.";
}

} catch (PDOException $e) {  //este en todo php
    echo "Error: " . $e->getMessage();  //este en todo php
}
?>