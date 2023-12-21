<?php

require_once "cors.php";

try {
    require_once "conexion.php";
        
    # capturamos datos a agregar
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $clave = filter_input(INPUT_POST, 'clave', FILTER_SANITIZE_STRING);
    $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);
   

    # Validación adicional si es necesario
    /*if (empty($nombre) || empty($clave) || empty($rol) || empty($estado)) {
        throw new Exception("Todos los campos son obligatorios");
    }*/
    # consulta para el borrado nombre
    $sql = "INSERT INTO `usuario` 
                (`nombre`, `clave`, `rol`) 
            VALUES 
                (:nombre, :clave, :rol)";

    $consulta = $conexion -> prepare($sql);

    $consulta ->execute (array(
        ":nombre" => $nombre,
        ":clave" => $clave,
        ":rol" => $rol,
      
    ));

    $respuesta = array ("status" => "ok", "message" => "Datos Insertados correctamente");
    
    header("Location: panel_control.php");
  
}
catch (PDOException $e){
    $respuesta = array ("status" => "error", "message" => "Error al insertar los datos: ". $e->getMessage());
}

header("Content-Type: application/json");

echo json_encode($respuesta);
?>

