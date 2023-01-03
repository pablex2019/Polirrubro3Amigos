<?php
    // Include config file
    require_once "../config.php";

    if(!empty($_POST)){
        if(isset($_POST["dniEdit"]) && isset($_POST["nombresEdit"]) && isset($_POST["apellidosEdit"]) && isset($_POST["correo_electrónicoEdit"])){
            if($_POST["dniEdit"]!=" " && $_POST["nombresEdit"]!=" " && $_POST["apellidosEdit"]!=" " && $_POST["correo_electrónicoEdit"]!=" "){
                $usuario = $_POST["usuarioEdit"];
                $clave = $_POST["claveEdit"];
                if($usuario!=""||$clave!=""){
                    $usuario = $_POST["usuarioEdit"];
                    $clave = password_hash($_POST["claveEdit"],PASSWORD_DEFAULT);
                } else {
                    $usuario = NULL;
                    $clave = NULL;
                }
                $sql = "update empleado set dni=\"$_POST[dniEdit]\",nombres=\"$_POST[nombresEdit]\", apellidos=\"$_POST[apellidosEdit]\",
                correo_electrónico=\"$_POST[correo_electrónicoEdit]\",usuario=\"$usuario\",clave=\"$clave\",estado=0, PERFIL_id=\"$_POST[perfilEdit]\"
                where id=".$_POST["idEdit"];

                $query = $link->query($sql);
                if($query!=null){
                    print "<script>alert(\"Actualizado correctamente.\");window.location='../employee.php';</script>";
                }else{
                    print "<script>alert(\"No se pudo actualizar.\");window.location='../employee.php';</script>";

                }
        }else{
                print "<script>alert(\"No se puedo agregar, porque hay campos incompletos.\");window.location='../employee.php';</script>";
            }
        }
    }
?>