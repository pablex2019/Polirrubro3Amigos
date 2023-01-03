<?php
// Include config file
require_once "../config.php";
error_reporting(0);

//Eliminar
if(!empty($_GET)){
    $sql = "UPDATE empleado set estado = 1 WHERE id=".$_GET["id"];
    $query = $link->query($sql);
    if($query!=null){
        print "<script>alert(\"Eliminado exitosamente.\");window.location='../employee.php';</script>";
    }else{
        print "<script>alert(\"No se pudo eliminar.\");window.location='../employee.php';</script>";
    }
}
?>