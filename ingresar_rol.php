<?php

require_once "cors.php";

try {
    require_once "conexion.php";
        
    # capturamos datos a agregar
    // $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    // $clave = filter_input(INPUT_POST, 'clave', FILTER_SANITIZE_STRING);
    $Descripcion = filter_input(INPUT_POST, 'Descripcion', FILTER_SANITIZE_STRING);
   

    # Validación adicional si es necesario
    /*if (empty($nombre) || empty($clave) || empty($rol) || empty($estado)) {
        throw new Exception("Todos los campos son obligatorios");
    }*/
    # consulta para el borrado nombre
    $sql = "INSERT INTO `rol` 
                (`Descripcion`) 
            VALUES 
                (:Descripcion)";

    $consulta = $conexion -> prepare($sql);

    $consulta ->execute (array( 
        ":Descripcion" => $Descripcion,
    ));

    $respuesta = array ("status" => "ok", "message" => "Rol Insertado correctamente");
    
    header("Location: panel_control.php");
  
}
catch (PDOException $e){
    $respuesta = array ("status" => "error", "message" => "Error al insertar los datos: ". $e->getMessage());
}

header("Content-Type: application/json");

echo json_encode($respuesta);
?>

